<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title></title>
    <!--[if !mso]><!-- -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style>
    <!--[if !mso]><!-->
    <style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style>
    <!--<![endif]--><!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]--><!--[if lte mso 11]>
    <style type="text/css">  .outlook-group-fix {    width:100% !important;  }</style>
    <![endif]--><!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">
    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Lato);  @import url(https://fonts.googleapis.com/css?family=Roboto);  @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style>
    <!--<![endif]-->
    <style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-50 { width:50%!important; }.mj-column-per-100 { width:100%!important; }.mj-column-per-60 { width:60%!important; }.mj-column-per-40 { width:40%!important; }  }</style>
</head>
<body style="background: #FFFFFF;">
<div class="mj-container" style="background-color:#FFFFFF;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]-->
                @include('emails.layouts.header')
                <!--[if mso | IE]>
            </td>
        </tr>
    </table>
    <![endif]-->      <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]-->
                @yield('content')
                <!--[if mso | IE]>
            </td>
        </tr>
    </table>
    <![endif]-->      <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]-->
                @include('emails.layouts.footer')
                <!--[if mso | IE]>
            </td>
        </tr>
    </table>
    <![endif]-->
</div>
</body>
</html>
