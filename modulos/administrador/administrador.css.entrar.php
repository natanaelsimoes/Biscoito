<style type="text/css">
    
    * { border: 0; border-collapse: collapse; list-style: none; margin: 0; padding: 0; position: relative; text-align: left; text-decoration: none; }
    
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: "Helvetica Neue", Helvetica, "Trebuchet MS", Arial, Verdana, sans-serif;
        background-color: #333;
        background-image: -moz-radial-gradient(50% 50%, closest-side, gray, black);
        background-image: -webkit-radial-gradient(50% 50%, closest-side, gray, black);
        background-image: -o-radial-gradient(50% 50%, closest-side, gray, black);
        background-image: -ms-radial-gradient(50% 50%, closest-side, gray, black);
        background-image: radial-gradient(50% 50%, closest-side, gray, black);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#666666', endColorstr='#000000',GradientType=1 );
    }

    .clear { clear:both; }

    .glass { 
        border: 1px solid rgba(0,0,0,0.5);
        border-bottom: 3px solid rgba(0,0,0,0.5);

        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;

        box-shadow: 
            0 2px 8px rgba(0,0,0,0.5), /* Exterior Shadow */
            inset 0 1px rgba(255,255,255,0.3), /* Top light Line */
            inset 0 10px rgba(255,255,255,0.2), /* Top Light Shadow */
            inset 0 10px 20px rgba(255,255,255,0.25), /* Sides Light Shadow */
            inset 0 -15px 30px rgba(0,0,0,0.3); /* Dark Background */

        -o-box-shadow: 
            0 2px 8px rgba(0,0,0,0.5),
            inset 0 1px rgba(255,255,255,0.3),
            inset 0 10px rgba(255,255,255,0.2),
            inset 0 10px 20px rgba(255,255,255,0.25),
            inset 0 -15px 30px rgba(0,0,0,0.3);

        -webkit-box-shadow: 
            0 2px 8px rgba(0,0,0,0.5),
            inset 0 1px rgba(255,255,255,0.3),
            inset 0 10px rgba(255,255,255,0.2),
            inset 0 10px 20px rgba(255,255,255,0.25),
            inset 0 -15px 30px rgba(0,0,0,0.3);

        -moz-box-shadow:
            0 2px 8px rgba(0,0,0,0.5),
            inset 0 1px rgba(255,255,255,0.3),
            inset 0 10px rgba(255,255,255,0.2),
            inset 0 10px 20px rgba(255,255,255,0.25),
            inset 0 -15px 30px rgba(0,0,0,0.3);
    }

    .glass.black {
        color: white;
        
        background: rgba(0,0,0,0.25);

        text-shadow: /* Simulating Text Stroke */
            -1px -1px 0 #000, 
            1px -1px 0 #000, 
            -1px 1px 0 #000, 
            1px 1px 0 #000;
    }
    
    .glass.white {
        color: black;
        
        background: rgba(255,255,255,0.25);

        text-shadow: /* Simulating Text Stroke */
            -1px -1px 0 #fff, 
            1px -1px 0 #fff, 
            -1px 1px 0 #fff, 
            1px 1px 0 #fff;
    }

    #corpo {
        top: 180px;
        top: 30%;
    }

    header {
        color: white;
        font-size: 40px;
        font-weight: bold;
        text-align: center;
        text-shadow: 5px 5px 5px black;
        padding: 20px;
    }

    fieldset {
        margin: 0px auto;
        width: 400px;
        height: 90px;

        padding:10px;
    }

    label {
        color: white;
        font-size: 18px;
        display: inline-block;
        width: 80px;
    }

    p {
        text-align: center;
        padding: 5px;
    }

    input {
        width: 250px;
        height: 25px;
        text-indent: 10px;
        letter-spacing: 0.1em;
        font-size: 20px;
    }

    button {
       margin-top: -7px;
       font-weight: bold;
       font-size: 25px;
       width: 422px;
       padding: 5px;
       text-align: center;
       cursor: pointer;
    }
    button:hover {
        background: rgba(255,255,255,0.5) !important;
    }
</style>