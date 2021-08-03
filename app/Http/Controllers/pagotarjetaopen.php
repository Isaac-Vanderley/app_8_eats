<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Openpay;
use Openpay\Data\OpenpayApi;
use Openpay\Data\OpenpayApiAuthError;
use Openpay\Data\OpenpayApiConnectionError;
use Openpay\Data\OpenpayApiError;
use Openpay\Data\OpenpayApiRequestError;
use Openpay\Data\OpenpayApiTransactionError;

class pagotarjetaopen extends Controller
{
    public function procesar(Request $request){
        
        try{
            $openpay= Openpay::getInstance("mceaafecffq93uzbfh2v". "sk_58499e49b8f24feb9002106a6f4c661a", 'MX');
            Openpay::setProductionMode(false);

            $customer = array(
                'name' => 'Juan',
                'last_name'=> 'OLva',
                'phone_number'=> '',
                'email'=> 'juan@gmail.com');

            $chargeData = array(
                'method' => 'card',
                'source_id'=> $_POST['token_id'],
                'send_email'=> true,
                'currency'=>'MXN',
                'amount'=> 200,
                'description'=>'Pago Fac: ',
                'use-card-points'=>false,
                'device_session_id'=> $_POST["deviceIdHiddenFieldName"],
                'customer'=> $customer
            );

            $charge=$openpay->charges->create($chargeData);


            return $charge;

        }catch (OpenpayApiTransactionError $e){

            return $e->getErrorCode(). '=>'. $e->getMessage();

                }catch (OpenpayApiRequestError $e){

                    return 'ERROR on the request: '.$e->getMessage();

                        }catch (OpenpayApiConnectionError $e){

                            return 'ERROR while connecting to the API: '.$e->getMessage();
        
                                }catch (OpenpayApiAuthError $e){

                                    return 'ERROR on the aunthentication: '.$e->getMessage();
                
                                        }catch (OpenpayApiError $e){

                                            return 'ERROR on the API '.$e->getMessage();
                        
                                                }
                                                catch (OpenpayApiTransactionError $e){

                                                    return $e->getMessage();
                                
                                                        }
                                

    }
}
