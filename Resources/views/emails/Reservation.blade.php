<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  @includeFirst(['ibooking.emails.style', 'ibooking::emails.base.style'])
  

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
        
            <tbody>
            
            <tr>
                <td height="30"></td>
            </tr>
            
            <tr bgcolor="#4c4e4e">
                <td width="100%" align="center" valign="top" bgcolor="#4c4e4e">
        
                    @includeFirst(['ibooking.emails.header', 'ibooking::emails.base.header'])
        
                  
                    <!----------   main content------------>
                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="container" bgcolor="F2F2F2">
        
        
                        <!--------- Header  ---------->
                        <tbody>
        
                        <tr bgcolor="F2F2F2">
                            <td height="20"></td>
                        </tr>
                        <!---------- end header --------->
        
        
                        <!--------- main section --------->
                        <tr>
                            <td>
                                <table border="0" width="560" align="center" cellpadding="0" cellspacing="0"
                                       class="container-middle">
        
                                    <tbody>
                                    <tr>
                                        <td align="center">
                                            <td height="25"></td>
                                        </td>
                                    </tr>
        
                                    <tr bgcolor="ffffff">
                                        <td height="7"></td>
                                    </tr>
                                 
                                    <tr bgcolor="ffffff">
                                        <td height="20"></td>
                                    </tr>
        
                                    <tr bgcolor="ffffff">
                                        <td>
                                            @includeFirst(['ibooking.emails.content', 'ibooking::emails.base.content'])
                                        </td>
                                    </tr>
        
                                    <tr bgcolor="ffffff">
                                        <td height="25"></td>
                                    </tr>
        
                                    <tr>
                                        <td align="center">
                                            <td height="25"></td>
                                        </td>
                                    </tr>
        
                                    </tbody>
                                </table>
                            </td>
                        </tr><!--------- end main section --------->
        
        
                        <tr>
                            <td height="20"></td>
                        </tr>
        
                        <!---------- prefooter  --------->
        
                        <tr>
                            <td>
                                <table border="0" width="560" align="center" cellpadding="0" cellspacing="0"
                                       class="container-middle">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" align="center" cellpadding="0" cellspacing="0" class="nav">
                                                <tbody>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" mc:edit="socials"
                                                        style="font-size: 13px; font-family: Helvetica, Arial, sans-serif;">
                                                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a style="display: block; width: 16px;"
                                                                       href="https://www.facebook.com/Insidious-Escape-Room-196369761309034/"><img
                                                                                editable="true" mc:edit="facebook" width="16"
                                                                                style="display: block;"
                                                                                src="{{ Theme::url('img/email/social-facebook.png') }}"
                                                                                alt="facebook"></a>
                                                                </td>
                                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                                <td>
                                                                    <a style="display: block; width: 16px;"
                                                                       href="https://www.instagram.com/insidiousescape/"><img
                                                                                editable="true" mc:edit="twitter" width="16"
                                                                                style="display: block;"
                                                                                src="{{ Theme::url('img/email/social-instagram.png') }}"
                                                                                alt="instagram"></a>
                                                                </td>
                                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                                <td>
                                                                    <a style="display: block; width: 16px;"
                                                                       href="https://www.youtube.com/channel/"><img
                                                                                editable="true" mc:edit="youtube" width="16"
                                                                                style="display: block;"
                                                                                src="{{ Theme::url('img/email/social-youtube.png') }}"
                                                                                alt="youtube"></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr><!---------- end prefooter  --------->
        
        
                        <tr>
                            <td height="30"></td>
                        </tr>
        
                        <tr>
                            <td align="center" mc:edit="copy2"
                                style="color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;"
                                class="prefooter-subheader">
                                <multiline>
                                    <span style="color: #de050f">Punto de Encuentro: </span> Plaza de la Fuente 1 (Arco de la Villa) – NALDA&nbsp;&nbsp;&nbsp; <span
                                            style="color: #de050f">Tlf :</span> 679542333 &nbsp;&nbsp;&nbsp;<span
                                            style="color: #de050f">Email :</span> info@insidious.es
        
                                </multiline>
                            </td>
                        </tr>
        
                        <tr>
                            <td height="30"></td>
                        </tr>
                        </tbody>
                    </table>
                    <!------------ end main Content ----------------->
        
                    @includeFirst(['ibooking.emails.footer', 'ibooking::emails.base.footer'])
                    
                </td>
            </tr>
        
            <tr>
                <td height="30"></td>
            </tr>
        
            </tbody>
            
            
        </table>
</body>

</html>