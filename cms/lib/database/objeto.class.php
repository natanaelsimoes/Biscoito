<?php

namespace Biscoito\Lib\Database;

define('CREATED', 0);
define('READED', 1);
define('UPDATED', 2);
define('DELETED', 3);

class TObjeto {

    /**
     * Chave primaria da tabela
     * @var integer 
     */
    private $FiId;

    /**
     * Estado do registro. Preferivel usar as constantes 
     * @var integer
     */
    private $FiEstado;

    /**
     * Instancia do objeto com os dados originais. Depois de preenchido $this->old = clone($this);
     * @var GF_Objeto 
     */
    private $FobAntigo;

    /**
     * Indica se o objeto foi criado por ORM
     * @var bool 
     */
    private $FbCriadoOrm;

    public function getId() {
        return $this->FiId;
    }

    public function getEstado() {
        return $this->FiEstado;
    }

    /**
     * 
     * @param type $data 
     */
    public function __construct() {
        $this->FiEstado = CREATED;
    }

    /**
     * Verifica a existencia de um atributo na classe
     * @param mixed $attr 
     */
    private function __exists($attr) {
        if (!property_exists($this, $attr))
            die('Atributo inexistente na classe \'' . get_class($this) . '\': ' . $attr);
    }

    /**
     * Serializa todo o objeto para fiz de exibicao ou armazenagem
     * @return string
     */
    public function __toString() {

        global $_Biscoito;

        $serial = serialize($this);

        return ($_Biscoito->getSOServidor() == 'Windows') ? str_replace("\0", "~~NULL_BYTE~~", $serial) : base64_encode($serial);
    }

    /**
     * Desatribui o valor de um atributo
     * @uses __exists()
     * @param mixed $attr
     * @return bool 
     */
    public function __unset($attr) {
        $this->__exists($attr);
        unset($this->$attr);
        return true;
    }

    /**
     * Executa sql necessario para a delecao do objeto. Lembre-se de inutilizar o objeto apos sua delecao.
     */
    public function DeletarRegistro() {

        $table = TDatabaseUtil::getClasseNamespace(get_class($this));

        /*     switch ($this->getEstado()) {

          case CREATED:

          die(__METHOD__ . '(). O objeto nunca foi salvo no banco de dados ou o mÃ©todo foi chamado de um local nÃ£o permitido.');

          default:
         */
        $query = " DELETE FROM $table WHERE id = {$this->getId()} ";

        $bd = new TDatabase;

        $bd->AbrirConexao();

        $bd->ExecutarComando($query, $this);

        /*         break;
          } */
    }

    private function ExistePropriedade($obj, $attr) {
        return property_exists($obj, $attr);
    }

    private function CarregarArray(Array $row) {
        foreach ($row as $attr => $value)
            if (!ExistePropriedade($this, $attr))
                throw new InvalidArgumentException('Atributo inexistente na classe \'' . __CLASS__ . '\': ' . $attr);
            else
                $this->$attr = $value;

        $this->FobAntigo = clone($this);

        $this->FiEstado = READED;
    }

    public function CarregarObjeto($obj) {

        foreach (get_object_vars($obj) as $attr => $value)
            if (!$this->ExistePropriedade($obj, $attr))
                throw new InvalidArgumentException('Atributo inexistente na classe \'' . __CLASS__ . '\': ' . $attr);
            else if ($attr != 'FiId') {
                $setAttr = "set$attr";
                $this->$setAttr($value);
            }
            else
                $this->$attr = $value;

        $this->FobAntigo = clone($this);

        $this->FiEstado = READED;
    }

    public function CarregarSerial($serial) {

        if (!empty($serial) && is_string($serial)) {

            global $_Biscoito;

            $serial = ($_Biscoito->getSOServidor() == 'Windows') ? str_replace("~~NULL_BYTE~~", "\0", $serial) : base64_decode($serial);

            $obj = unserialize($serial);

            if (($className = get_class($obj)) === false)
                throw new \InvalidArgumentException('Serial nÃ£o criou um objeto');

            if ($className != ($expectedClassName = (get_class($this))))
                throw new \InvalidArgumentException('Serial criou um objeto da classe \'' . $className . '\'. Classe esperada: \'' . $expectedClassName);

            $arrClassName = explode('\\', $className);

            $trueClassName = end($arrClassName);

            foreach ($this->MapearClasse($this) as $attr => $value) {

                $attr = str_replace("$trueClassName.", '', $attr);

                $attrSet = "set$attr";

                $attrGet = "get$attr";

                $this->$attrSet($obj->$attrGet());
            }

            foreach (get_object_vars($obj) as $attr => $value)
                $this->$attr = $value;

            $this->FobAntigo = clone($this);

            $this->FiEstado = READED;
        }
    }

    public function DeletarObjetoRelacionado(&$array, $obj) {

        if (!is_array($array))
            die(__METHOD__ . '() foi executado mas o atributo não é um array.');

        if (gettype($obj) == 'integer') {
            if (array_key_exists($obj, $array))
                $array[$obj]->FiEstado = DELETED;
            else
                die(__METHOD__ . '() foi executado mas o atributo não possui a chave ' . $obj);
        }
        else {
            $newObj = clone($obj);
            $newObj->FiEstado = CREATED;
            $keys = array_keys($array, $newObj);
            if (count($keys) > 0)
                foreach ($keys as $key)
                    $array[$key]->FiEstado = DELETED;
            else
                die(__METHOD__ . '() foi executado mas o objeto não foi encontrado no atributo.');
        }
    }

    /**
     * Inclui num atributo do objeto a instancia de uma outra classe componente ou agregada a este.
     * Utilizado em relacionamentos 1N / NN.
     * @param mixed $array O atributo onde serao guardadas as instancias
     * @param GF_Object $obj A instancia do objeto componente ou agregado
     */
    public function AdicionarObjetoRelacionado(&$array, $obj) {

        if (!is_array($array))
            $array = array();

        $newObj = clone($obj);

        $newObj->FiEstado = CREATED;

        array_push($array, $newObj);
    }

    public function Salvar() {

        $table = TDatabaseUtil::getClasseObjeto($this);

        $configuracaoClasse = TDatabaseUtil::getConfiguracaoClasse(get_class($this));

        $queuedQueries = array();

        $query = $fields = $values = $where = '';

        switch ($this->getId()) {
            case false: #INSERT 

                foreach ($this->MapearClasse($this) as $col => $value) {

                    $colInfo = explode('.', $col);

                    $colTable = $colInfo[0];

                    $colName = $colInfo[1];

                    $getCol = "get$colName";

                    $value = $this->$getCol();

                    $hasDefaultValue = (strpos(strtoupper($configuracaoClasse->classes->$table->$colName), 'DEFAULT') !== false);

                    if (is_object($value)) {
                        $foreignTable = strtolower(get_class($value));
                        $fields.= "{$foreignTable}_id,";
                        $values.= "'{$value->getId()}',";
                    } else if (is_array($value)) {
                        foreach ($value as $objItem) {
                            $foreignTable = strtolower(get_class($objItem));
                            $queryForeign = " INSERT INTO {$table}_{$foreignTable} ({$table}_id, {$foreignTable}_id) ";
                            $queryForeign.= " VALUES ( ( SELECT MAX(id) FROM $table ) , {$objItem->getId()} ) ";
                            $queuedQueries[] = $queryForeign;
                        }
                    } else if ($hasDefaultValue && $value == '') {
                        $fields.= "$col,";
                        $values.= "DEFAULT,";
                    } else {
                        $fields.= "$col,";
                        $values.= ( empty($value)) ? "NULL," : "'$value',";
                    }
                }

                $fields = substr($fields, 0, -1);
                $values = substr($values, 0, -1);

                $query = " INSERT INTO $table ($fields) VALUES ($values) ";

                break;

            case true:   #UPDATE

                foreach ($this->MapearClasse($this) as $col => $value) {

                    $colInfo = explode('.', $col);

                    $colTable = $colInfo[0];

                    $colName = $colInfo[1];

                    $getCol = "get$colName";

                    $value = $this->$getCol();

                    $hasDefaultValue = (strpos(strtoupper($configuracaoClasse->classes->$table->$colName), 'DEFAULT') !== false);

                    if (is_object($value)) {

                        $foreignTable = strtolower(get_class($value));

                        $values.= "{$foreignTable}_id = '{$value->getId()}',";
                    } else if (is_array($value)) {
                        foreach ($value as $objItem) {
                            $foreignTable = strtolower(get_class($objItem));

                            if ($objItem->FiEstado == CREATED) {

                                $queryForeign = " INSERT INTO {$table}_{$foreignTable} ({$table}_id, {$foreignTable}_id) ";

                                $queryForeign.= " VALUES ( {$this->getId()} , {$objItem->getId()} ) ";

                                $queuedQueries[] = $queryForeign;
                            } else if ($objItem->FiEstado == DELETED) {

                                $queryForeign = " DELETE FROM {$table}_{$foreignTable} WHERE ";

                                $queryForeign.= " {$table}_id = '{$this->getId}' AND {$foreignTable}_id = '$objItem->getId' ";

                                $queuedQueries[] = $queryForeign;
                            }
                        }
                    } else if ($hasDefaultValue && $value == '') {
                        $value.= "$col = DEFAULT,";
                    } else {
                        $values.= ( empty($value)) ? "$col = NULL," : "$col = '$value',";
                    }
                }

                $where = "id = {$this->getId()}";

                $values = substr($values, 0, -1);

                $query = " UPDATE $table SET $values WHERE $where ";

                break;
        }

        #var_dump($query);
        #var_dump($queuedQueries);

        $bd = new TDatabase;

        $bd->AbrirConexao();

        $bd->ExecutarComando($query, $this);                
        
        if (!$this->getId()) {            
            
            $query = "SELECT max(id) id FROM $table";
            
            $ultimoRegistro = $bd->Selecionar($query);
            
            $this->FiId = $ultimoRegistro[0]->id;
        }

        foreach ($queuedQueries as $query)
            $bd->ExecutarComando($query, $this);       

        $this->FobAntigo = clone($this);

        $this->FiEstado = READED;
    }

    protected function setForeign(&$attr, $object) {

        $newObj = clone($object);

        $newObj->FiEstado = CREATED;

        $attr = $newObj;
    }
    
    public function QuantidadeRegistrados($whereCampo = null, $whereValor = null) {
        
        $table = TDatabaseUtil::getClasseNamespace(get_class($this));
        
        $query = "SELECT count(id) quantidade FROM $table";
        
        $bd = new TDatabase;
        
        $bd->AbrirConexao();                
        
        $quantidade = $bd->Selecionar($query);
        
        return $quantidade[0]->quantidade;
    }

    public function ListarTodos($pagina = 1, $quantidade = null) {

        $fields = "";

        $table = TDatabaseUtil::getClasseNamespace(get_class($this));

        foreach ($this->MapearClasse($this) as $col => $value)
            $fields.= "$col,";

        $fields = substr($fields, 0, -1);

        $query = "SELECT $table.id FiId,$fields FROM $table";

        $bd = new TDatabase;

        $bd->AbrirConexao();

        $lista = $bd->Selecionar($query, $this, $pagina, $quantidade);

        return $lista;
    }

    public function ListarTodosOnde($campo, $sinal, $valor, $pagina = 1, $quantidade = null) {

        $fields = "";

        $table = TDatabaseUtil::getClasseNamespace(get_class($this));

        foreach (array_keys($this->MapearClasse($this)) as $col)
            $fields.= "$col,";

        $fields = substr($fields, 0, -1);

        $query = " SELECT $table.id FiId,$fields FROM $table WHERE $campo $sinal $valor ";

        $bd = new TDatabase;

        $bd->AbrirConexao();

        return $bd->Selecionar($query, $this, $pagina, $quantidade);
    }

    public function ListarPorId($id) {

        $fields = "";

        $table = TDatabaseUtil::getClasseNamespace(get_class($this));

        foreach (array_keys($this->MapearClasse($this)) as $col)
            $fields.= "$col,";

        $fields = substr($fields, 0, -1);

        $query = " SELECT $table.id FiId,$fields FROM $table WHERE id = $id ";

        $bd = new TDatabase;

        $bd->AbrirConexao();

        $dados = $bd->Selecionar($query, $this);
        
        return $dados[0];
    }

    static public function MapearClasse($obj) {

        $obj_dump = print_r($obj, 1);
        $obj_class = '';
        $ret_list = $ret_map = $ARR_LIST_MATCH = array();
        $ARR_LIST_CLASS = $ret_name = '';
        $dump_lines = preg_split('/[\r\n]+/', $obj_dump);
        $ARR_NAME = 'arr_name';
        $ARR_LIST = 'arr_list';
        $arr_index = -1;

        // get the object type...
        $matches = array();
        $obj_class = TDatabaseUtil::getClasseObjeto($obj);
        preg_match('/^\s*(\S+)\s+\bObject\b/i', $obj_dump, $matches);
        if (isset($matches[1])) {
            $ret_name = $matches[1];
        }//if

        foreach ($dump_lines as &$line) {

            $matches = array();

            //load up var and values...
            if (preg_match('/^\s*\[\s*(\S+)\s*\]\s+=>\s+(.*)$/', $line, $matches)) {

                $ARR_LIST_MATCH = explode(':', $matches[1]);

                if (strpos($matches[0], 'TObjeto') === false && mb_stripos($matches[2], 'array') === false) {

                    $ARR_LIST_CLASS = TDatabaseUtil::getClasseNamespace($ARR_LIST_MATCH[1]);

                    $matches[1] = sprintf('%s.%s', $obj_class, $ARR_LIST_MATCH[0]);

                    if (mb_stripos($matches[2], 'array') !== false) {

                        $arr_map = array();
                        $arr_map[$ARR_NAME] = $matches[1];
                        $arr_map[$ARR_LIST] = array();
                        $arr_list[++$arr_index] = $arr_map;
                    } else {

                        // save normal variables and arrays differently...
                        if ($arr_index >= 0) {
                            $arr_list[$arr_index][$ARR_LIST][$matches[1]] = $matches[2];
                        } else {
                            if ($ARR_LIST_CLASS == $obj_class)
                                $ret_list[$matches[1]] = $matches[2];
                        }//if/else
                    }//if/else
                }
            } else {

                // save the current array to the return list...
                if (mb_stripos($line, ')') !== false) {

                    if ($arr_index >= 0) {

                        $arr_map = array_pop($arr_list);

                        // if there is more than one array then this array belongs to the earlier array...
                        if ($arr_index > 0) {
                            $arr_list[($arr_index - 1)][$ARR_LIST][$arr_map[$ARR_NAME]] = $arr_map[$ARR_LIST];
                        } else {
                            $ret_list[$arr_map[$ARR_NAME]] = $arr_map[$ARR_LIST];
                        }//if/else

                        $arr_index--;
                    }//if
                }//if
            }//if/else
        }//foreach

        $ret_map['name'] = $ret_name;
        $ret_map['variables'] = $ret_list;
        return $ret_list;
    }

}

?>