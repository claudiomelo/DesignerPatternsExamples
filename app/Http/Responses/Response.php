<?php 

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Validator;

class Response
{
    private static $message = '';
    private static $status = 'success';
    private static $data = [];
    private static $code = 200;
    private static $exception = false;
    private static $time = false;

    public static function __callStatic($name, $params)
    {
        $class = new self();

        return call_user_func_array([$class, $name], $params);
    }

    public function __call($name, $params)
    {
        return call_user_func_array([$this, $name], $params);
    }
   
    /**
	 * seta os parametros da resposta
	 * @param array $data
	 * @param array $code
	 * @param array $startTime
	 * @param array $message
	 * @param array $status
	 *
	 * @return void
    */
    public static function success($data, $code, $startTime = false, $message = 'success', $status = 'success'){
    	self::$data = $data;
    	self::$code = $code;
    	self::$message = $message;
    	self::$status = $status;

    	if ($startTime) {
    		$endTime = round(microtime(true) * 1000);
    		self::$time = (($endTime-$startTime)/1000);
    	}

    	return self::getResponse();
    }

    /**
     * Setar exceção lançada para ser enviada com a response (se ativado no env o debug de exceções)
     *
     * @param Exception $e
     */
    private static function exception($e)
    {
        if (env('APP_DEBUG'))
        {
            $this->setData([
                'error' =>  $e->getMessage(),
                'file'  =>  $e->getFile(),
                'line'  =>  $e->getLine(),
                'exceptionCode'  =>  $e->getCode(),
                'errorMessage' => $e->getMessage(),
                'class' =>  get_class($e),
                'trace' =>  $e->getTraceAsString()
            ], true);
        }

        return self::getResponse();
    }

    /**
     * Retorna a resposta em json
    */
    private static function getResponse()
    {
        return response()->json([
            'status' 	=> self::$status,
            'message' 	=> self::$message,
            'data'		=> self::$data,
            'code'		=> self::$code,
            'time'		=> self::$time,
        ], self::$code, [], JSON_PRETTY_PRINT)
            ->header('charset', 'utf-8');
    }
}
