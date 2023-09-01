 <style>
 	@media print{@page {size: portrait;}}
 	 .QrCodeOutput{
             background-color: #fff;
             text-align: center;
             padding-top: 10px;
             padding-bottom: 10px;

        }
    .col{
    	padding: 10px;
    }
    .upper {
	  text-transform: uppercase;
	}
	canvas{
		width: 100px;
		height: 100px;
	}
	@page {
	  size: A4;
	  margin: 0;
	}
	@media print {
	  html, body {
	    width: 210mm;
	    height: 297mm;
	  }
	  /* ... the rest of the rules ... */
	}



	
    .container {
      text-align: center;
    }

    /* Centered text */
    .centered_name {
      font-size:30px;
      font-weight: bold;
      text-transform: uppercase;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

        -webkit-transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -o-transform:rotateY(180deg);
        -ms-transform:rotateY(180deg);
        unicode-bidi:bidi-override;
        direction:rtl;
    }

    .less_size {
      font-size:27px;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 6px;
     
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

        -webkit-transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -o-transform:rotateY(180deg);
        -ms-transform:rotateY(180deg);
        unicode-bidi:bidi-override;
        direction:rtl;
    }

    .centered_inst {
      margin-top: -15px;
      font-size:25px;
      font-weight: bolder;

      text-transform: uppercase;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

        -webkit-transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -o-transform:rotateY(180deg);
        -ms-transform:rotateY(180deg);
        unicode-bidi:bidi-override;
        direction:rtl;
    }


    .centered_role {
      margin-top: -5px;
      font-size:45px;
      font-weight: bolder;
      text-transform: uppercase;
      color: #144a88;
      margin-bottom: 120px;
      -webkit-text-stroke: 0.5px white;
      font-family: arial black;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

        -webkit-transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -o-transform:rotateY(180deg);
        -ms-transform:rotateY(180deg);
        unicode-bidi:bidi-override;
        direction:rtl;
    }

    .centered_role_less {
      margin-top: 2px;
      font-size:32px;
      font-weight: bolder;
      text-transform: uppercase;
      color: #144a88;
      margin-bottom: 120px;

      -webkit-text-stroke: 0.5px white;
      font-family: arial black;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

        -webkit-transform:rotateY(180deg);
        -moz-transform:rotateY(180deg);
        -o-transform:rotateY(180deg);
        -ms-transform:rotateY(180deg);
        unicode-bidi:bidi-override;
        direction:rtl;
    }

    .qr_code{
        margin-left: 5px;
        margin-top: -72%;
        margin-bottom: 2%;
    }

    .imgID{
        height: 600px;
        margin-top: 40px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    canvas{
        margin-top: -110px;
        margin-left: -10px;
        width: 160px;
        height: 160px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    @media only screen   
            and (min-width: 1080px)   
            and (max-width: 1920px)  
            {

                .imgID{
                    height: 650px;
                    margin-top: 20px;
                }

                canvas{
                    margin-top: -4px;
                    width: 180px;
                    height: 180px;
                    margin-left: -10px;
                }

                .centered_inst {
                  margin-top: -12px;
                  font-size:20px;
                  font-weight: bolder;
                  text-transform: uppercase;
                }

                .centered_role {
                    margin-top: 4px;
                }
            } 

 </style>