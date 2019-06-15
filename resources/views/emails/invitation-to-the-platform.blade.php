@extends('emails.layouts.app')

@section('content')
    <div style="background-color:transparent;">
        <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                <!--[if (mso)|(IE)]>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;">
                    <tr>
                        <td align="center">
                            <table cellpadding="0" cellspacing="0" border="0" style="width:600px">
                                <tr class="layout-full-width" style="background-color:transparent">
                <![endif]-->
                <!--[if (mso)|(IE)]>
                <td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 10px; padding-left: 0px; padding-top:5px; padding-bottom:0px;background-color:#222222;">
                <![endif]-->
                <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top;;">
                    <div style="background-color:#222222;width:100% !important;">
                        <!--[if (!mso)&(!IE)]><!-->
                        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 10px; padding-left: 0px;">
                            <!--<![endif]-->
                            <!--[if mso]>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 20px; padding-left: 20px; padding-top: 30px; padding-bottom: 5px; font-family: Tahoma, Verdana, sans-serif">
                            <![endif]-->
                            <div style="color:#111111;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:30px;padding-right:20px;padding-bottom:5px;padding-left:20px;">
                                <div style="font-size: 12px; line-height: 14px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; color: #111111;">
                                    <p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;"><span style="color: #a17c44; font-size: 14px; line-height: 16px;"><span style="font-size: 26px; line-height: 31px;">Te Invitamos a nuestra plataforma!</span></span></p>
                                </div>
                            </div>
                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            <!--[if mso]>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-right: 20px; padding-left: 20px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif">
                            <![endif]-->
                            <div style="color:#888888;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;line-height:180%;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px;">
                                <div style="font-size: 12px; line-height: 21px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; color: #888888;">
                                    <p style="font-size: 12px; line-height: 23px; text-align: justify; margin: 0;"><span style="color: #ffffff; font-size: 13px; mso-ansi-font-size: 14px;">Hola <strong>{{explode(" ", $guestUser->name)[0]}}</strong>, queremos que formes parte de nuestro sistema de gestión para pastores impulsado por la Iglesia Luz del Mundo Barcelona Misión 31. {{$userAuth->name}} te ha sugerido para formar parte esta plataforma en calidad de:</span></p>
                                    <ul>
                                        @foreach (json_decode($guestUser->roles) as $role)
                                            <li style="font-size: 12px; line-height: 21px; text-align: justify;"><strong><span style="color: #ffffff; font-size: 13px; line-height: 23px; mso-ansi-font-size: 14px;">{{$role}}</span></strong></li>
                                        @endforeach
                                    </ul>
                                    <p style="font-size: 12px; line-height: 23px; text-align: justify; margin: 0;"><span style="color: #ffffff; font-size: 13px; mso-ansi-font-size: 14px;">De estar interesado en formar parte de la plataforma te invitamos a dar clic en el botón <strong>Unirme Ahora</strong> y seguir las instrucciones del formulario de registro.</span></p>
                                    <p style="font-size: 12px; line-height: 23px; text-align: center; margin-top: 20px;"><span style="color: #ffffff; font-size: 13px; mso-ansi-font-size: 14px;">Dios te bendiga y te siga llevando de victoria en victoria!</span></p>
                                </div>
                            </div>
                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            <div align="left" class="button-container" style="padding-top:15px;padding-right:30px;padding-bottom:30px;padding-left:30px;">
                                <!--[if mso]>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                    <tr>
                                        <td style="padding-top: 15px; padding-right: 30px; padding-bottom: 30px; padding-left: 30px" align="left">
                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{url('/register')}}" style="height:31.5pt; width:78pt; v-text-anchor:middle;" arcsize="0%" stroke="false" fillcolor="#A17C44">
                                                <w:anchorlock/>
                                                <v:textbox inset="0,0,0,0">
                                                    <center style="color:#000000; font-family:Tahoma, Verdana, sans-serif; font-size:14px">
                                <![endif]--><a href="{{url('/register')}}" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #000000; background-color: #A17C44; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width: auto; width: auto; border-top: 1px solid #A17C44; border-right: 1px solid #A17C44; border-bottom: 1px solid #A17C44; border-left: 1px solid #A17C44; padding-top: 5px; padding-bottom: 5px; font-family: 'Roboto', Tahoma, Verdana, Segoe, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:14px;display:inline-block;">
                                            <span style="font-size: 16px; line-height: 32px;"><span style="font-size: 14px; line-height: 28px;">UNIRME AHORA!</span></span>
                                            </span></a>
                                <!--[if mso]>
                                </center>
                                </v:textbox>
                                </v:roundrect>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </div>
                            <!--[if (!mso)&(!IE)]><!-->
                        </div>
                        <!--<![endif]-->
                    </div>
                </div>
                <!--[if (mso)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
                <!--[if (mso)|(IE)]>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                <![endif]-->
            </div>
        </div>
    </div>
@endsection
