<?php

class APIResponse
{
    public static function getResponse($varRespCode, $detail='') {
        echo "<br>Api response ".$varRespCode;
        $message = '';
        $success = FALSE;
        $response= '';

        switch ($varRespCode) {

            case '200':
                $success = TRUE;
                $response = '200';
                $message = 'The request has succeeded';
                break;

            case '201':
                $success = TRUE;
                $response = '201';
                $message = 'Limited success. One or more batch requests failed for the command executed.';
                break;

            case '204':
                $success = TRUE;
                $response = '204';
                $message = 'The request was successful, but the result is empty.';
                break;

            case '400':
                $success = FALSE;
                $response = '400';
                $message = 'Bad Request. One or more required parameters were missing or invalid';
                break;

            case '401':
                $success = FALSE;
                $response = '401';
                $message = 'Forbidden. User does not exist.';
                break;

            case '402':
                $success = FALSE;
                $response = '402';
                $message = 'Forbidden. Authorization token does not exist.';
                break;

            case '403':
                $success = FALSE;
                $response = '403';
                $message = 'Forbidden. Request is missing valid credentials.';
                break;

            case '405':
                $success = FALSE;
                $response = '405';
                $message = 'Method not allowed. The method specified in the Request-Line is not allowed for the resource identified by the Request-URI.';
                break;

            case '500':
                $success = FALSE;
                $response = '500';
                $message = 'Internal Server Error. The server encountered an unexpected condition which prevented it from fulfilling the request.';
                break;

            default:
                $success = TRUE;
                $response = '000';
                $message = 'Unknown application response request.';

        } // end switch

        // return array for when the API needs to return the passed params
        $returnArray = array('success' => $success, 'response' => $response, 'message' => $message);
        if($detail !== ''){
            $returnArray['message'] = $detail;
        }
        return $returnArray;
    }

}