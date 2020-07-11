<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Gestor;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
use App\Mail\SendMailUser;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioLogado = auth()->user();

        try {
            if ($usuarioLogado->administrador) {
                $usuario = Usuario::all();
                $usuario->load('empresa');
                $usuario->load('gestors');
                return $usuario;
            } else {
                $usuario= Usuario::where('fkEmpresa', $usuarioLogado->fkEmpresa)->get();
                $usuario->load('gestors');
                $usuario->load('empresa');
                return $usuario;
            }
            return Usuario::all();
        } catch (\Exception $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function show($id)
    {

        try {
            return Usuario::find($id);
        } catch (\Exception $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cpf' => 'cpf'
            ]
        );
        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "CPF inválido.",
                ],
            ];

            return response()->json($json, 400);
        }

        if (Usuario::where('cpf', $request->cpf)->first() != NULL) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "Este CPF já esta cadastrado.",
                ],
            ];

            return response()->json($json, 400);
        } else  if (Usuario::where('email', $request->email)->first() != NULL) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "Este Email já esta cadastrado.",
                ],
            ];

            return response()->json($json, 400);

        } else {
            try {

                $usuarioLogado = auth()->user();

                $gestores = Gestor::where('fkUsuario', $usuarioLogado->pkUsuario)->first();

                // if(isset($gestores)){
                //     $usuario->fkSetor = $usuarioLogado->fkSetor;
                // }
                
                $usuario    = Usuario::create($request->all());
                $senha      = Str::random(8);
                //$usuario->password = Hash::make($senha);
                $usuario->password = $senha;

                if (!$usuarioLogado->administrador) {

                    $usuario->fkEmpresa = $usuarioLogado->fkEmpresa;
                            
                    if($gestores->ehmaster != true){
                        $usuario->fkSetor = $usuarioLogado->fkSetor;
                    }
                
                }else{
                    $gestorMaster = Gestor::create([
                        'fkEmpresa' => $request->fkEmpresa,
                        'fkUsuario' => $usuario->pkUsuario,
                        'ehmaster'  => true,
                    ]);
                }

                // $this->sendEmail($usuario->email, $senha);
                Mail::to($usuario->email)
                ->cc('contato@lborges.com.br')

                ->send(new SendMailUser($senha, $usuario->nome));



                $usuario->save();
                return json_encode( $usuario);
            } catch (\Exception $e) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                    ],
                ];

                return response()->json($json, 400);
            }
        }
    }
    public function sendEmail($email, $senha)
    {
        // is method a POST ?
        // load Composer's autoloader

        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

        try {
            // Server settings
            $mail->SMTPDebug = 0;                                    // Enable verbose debug output
            $mail->isSMTP();                                         // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                                                // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                  // Enable SMTP authentication
            $mail->Username = 'gerentededesenvolvimento@toptecnologia.com';             // SMTP username
            $mail->Password = '!R0s@2208*21&07';              // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('gerentededesenvolvimento@toptecnologia.com', 'Gerente de Desenvolvimento');
            $mail->addAddress('gerentededesenvolvimento@toptecnologia.com', 'Gerente de Desenvolvimento');    // Add a recipient, Name is optional

            $mail->addCC($email);
            $mail->addBCC('gerentededesenvolvimento@toptecnologia.com');

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

            //Content
            $mail->isHTML(true);                                                                     // Set email format to HTML
            $mail->Subject = "Diztribui Envio de Senha";
            $mail->Body    = "Olá, voce acaba de ser cadastrado no sistema Diztribui<br> para acessar utilizae seu email e a seguinte senha:<br><b>" + $senha;                      // message

            $mail->send();
            return 'Message has been sent!';
        } catch (Exception $e) {
            return 'Message could not be sent.';
        }
    }

    public function update(Request $request, $id)
    {

        // APGAR IMAGEM ANTIGA SE EXISTIR
        // $img_old = $usuario->urlImagem;
        // Storage::disk('public')->delete($img_old);


        if ($request->senha !== $request->confirmasenha) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "Senhas diferentes.",
                ],
            ];

            return response()->json($json, 400);
        } else if ($request->senha == NULL) {
            try {
                $usuario = Usuario::find($id);
                $usuario = $usuario->update([
                    'nome'      => $request->nome,
                    'email'     => $request->email,
                    'cpf'       => $request->cpf,
                    'telefone'  => $request->telefone,
                    'fkEmpresa' => $request->empresa,
                    'fkSetor'   => $request->setor,
                    'fkCargos'  => $request->cargos,
                    'facebook'  => $request->facebook,
                    'instagram' => $request->instagram,
                    'twitter'   => $request->twitter,
                    'linkedin'  => $request->linkedin,
                    'site'      => $request->site,
                ]);
                return json_encode($usuario);
            } catch (\Exception $e) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                    ],
                ];

                return response()->json($json, 400);
            }
        } else {
            try {
                $usuario = Usuario::find($id);
                $usuario = $usuario->update($request->all());

                return json_encode($usuario);
            } catch (\Exception $e) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                    ],
                ];

                return response()->json($json, 400);
            }
        }
    }

    public function destroy(Request $request, $id)
    {

        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            return 204;
        } catch (\Exception $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }
}