<?php
/**
 * 2018-2023 Optyum S.A. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Optyum S.A. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Optyum S.A.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Optyum S.A.
 *
 * @author    Optyum S.A.
 * @copyright 2018-2023 Optyum S.A.
 * @license  Optyum S.A. All Rights Reserved
 *  International Registered Trademark & Property of Optyum S.A.
 */

namespace PrestaShop\Module\shopylinkerp\Classes;

if (!defined('_PS_VERSION_')) {
    exit;
}

class HTTPErrorHelper
{
    static public function getErrorMessage($httpCode)
    {
        $errorMessages = array(
            400 => 'Code 400: The server could not understand the request.',
            401 => 'Code 401: Authentication is required to access this resource.',
            402 => 'Code 402: Payment is required to access this resource.',
            403 => 'Code 403: This error occurs because shopylinker.com cannot connect to the server. The server may have blocked the connection by CURL or external ips ect. You should contact your server administrator to fix it.
If you need help or information you can also contact us via Prestashop.',
            404 => 'Code 404: The requested resource was not found.',
            405 => 'Code 405: The requested method is not allowed for this resource.',
            406 => 'Code 406: The requested resource is not available in the requested format.',
            407 => 'Code 407: Proxy authentication is required to access this resource.',
            408 => 'Code 408: The server timed out waiting for the request.',
            409 => 'Code 409: The request could not be completed due to a conflict with the current state of the resource.',
            410 => 'Code 410: The requested resource is no longer available and has been permanently removed.',
            411 => 'Code 411: The server requires a Content-Length header.',
            412 => 'Code 412: The precondition specified in the request failed.',
            413 => 'Code 413: The request entity is larger than the server is willing or able to process.',
            414 => 'Code 414: The request URI is too long and cannot be processed.',
            415 => 'Code 415: The request entity has a media type which the server or resource does not support.',
            416 => 'Code 416: The requested range is not satisfiable for the current resource.',
            417 => 'Code 417: The expectation specified in the Expect request header cannot be met by the server.',
            418 => "Code 418: I'm a teapot.",
            421 => 'Code 421: The request was directed at a server that is not able to produce a response.',
            422 => 'Code 422: The server understands the content type of the request entity but was unable to process the contained instructions.',
            423 => 'Code 423: The requested resource is currently locked.',
            424 => 'Code 424: The method could not be performed on the resource because the requested action depended on another action and that action failed.',
            425 => 'Code 425: The server is unwilling to risk processing a request that might be replayed.',
            426 => 'Code 426: Upgrade Required.',
            428 => 'Code 428: The origin server requires the request to be conditional.',
            429 => 'Code 429: Too Many Requests.',
            431 => 'Code 431: The server is unwilling to process the request because the request header fields are too large.',
            451 => 'Code 451: Unavailable For Legal Reasons.',
            500 => 'Code 500: The server encountered an internal error and was unable to complete your request.',
            501 => 'Code 501: The server does not support the requested feature.',
            502 => 'Code 502: The server received an invalid response from an upstream server.',
            503 => 'Code 503: The server is currently unavailable. Please try again later.',
            504 => 'Code 504: The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.',
            505 => 'Code 505: The server does not support the HTTP protocol version used in the request.',
            506 => 'Code 506: The server has detected an infinite loop while processing the request.',
            507 => 'Code 507: The server is unable to store the representation needed to complete the request.',
            508 => 'Code 508: The server detected an infinite loop while processing the request.',
            510 => 'Code 510: Further extensions to the request are required for the server to fulfill it.',
            511 => 'Code 511: Network Authentication Required.'
        );

        $message = '';

        if (isset($errorMessages[$httpCode])) {
            $message = $errorMessages[$httpCode];
        }

        return $message;
    }
}