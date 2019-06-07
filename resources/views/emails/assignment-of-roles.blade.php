@extends('emails.layouts.app')

@section('content')
    <table role="presentation" cellpadding="0" cellspacing="0" style="background:#FFFFFF;font-size:0px;width:100%;" border="0">
        <tbody>
        <tr>
            <td>
                <div style="margin:0px auto;max-width:600px;">
                    <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0">
                        <tbody>
                        <tr>
                            <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px 0px 0px 0px;">
                                <!--[if mso | IE]>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="vertical-align:top;width:600px;">
                                <![endif]-->
                                <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                                    <table role="presentation" cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:10px;">
                                                <p style="font-size:1px;margin:0px auto;border-top:1px solid #FFFFFF;width:100%;"></p>
                                                <!--[if mso | IE]>
                                                <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:1px solid #FFFFFF;width:100%;" width="600">
                                                    <tr>
                                                        <td style="height:0;line-height:0;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;padding:0px 1px 0px 0px;" align="center">
                                                <div style="cursor:auto;color:#FFFFFF;font-family:Roboto, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;">
                                                    <h1 style="font-family: 'Cabin', sans-serif; color: #FFFFFF; font-size: 32px; line-height: 100%;"><span style="color:#4e5f70;">Nuevos Roles Asignados!</span></h1>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;padding:0px 10px 25px 10px;" align="justify">
                                                <div style="cursor:auto;color:#000000;font-family:Roboto, Tahoma, sans-serif;font-size:11px;line-height:1.5;text-align:justify;">
                                                    <p><span style="font-size:14px;"><span style="color:#2c3e50;">Hola&nbsp;<strong>{{ $user->name }}</strong>, te escribo para informarte que se te han asignado&nbsp;nuevos roles en la plataforma, esto te permitirá&nbsp;tener&nbsp;privilegios adicionales a los comunes en el sistema y acceso a funcionalidades nuevas, los roles que se te han asignado son en la calidad de&nbsp;<strong>{{ implode(', ', $assignedRoles) }}</strong>. Te invitamos a&nbsp;<strong>Iniciar Sesión</strong>&nbsp;en nuestra plataforma y empezar a disfrutar de tus nuevos privilegios en el sistema.&nbsp; Dios te bendiga y que te siga llevando de victoria en victoria!</span></span></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="word-wrap:break-word;font-size:0px;padding:1px 0px 37px 0px;" align="center">
                                                <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;width:auto;" align="center" border="0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:12px 36px;" align="center" valign="middle" bgcolor="#275877"><a href="{{ url('/login') }}" style="text-decoration:none;background:#275877;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:18px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Iniciar Sesion</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
