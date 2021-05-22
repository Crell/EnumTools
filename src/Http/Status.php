<?php
declare(strict_types=1);

namespace Crell\EnumTools\Http;

enum Status: int
{
    // RFC7231, Section 6.2.1
    case Continue = 100;
    // RFC7231, Section 6.2.2
    case Switching_Protocols = 101;
    // RFC2518
    case Processing = 102;
    // RFC8297
    case Early_Hints = 103;

    // RFC7231, Section 6.3.1
    case OK = 200;
    // RFC7231, Section 6.3.2
    case Created = 201;
    // RFC7231, Section 6.3.3
    case Accepted = 202;
    // RFC7231, Section 6.3.4
    case Non_Authoritative_Information = 203;
    // RFC7231, Section 6.3.5
    case No_Content = 204;
    // RFC7231, Section 6.3.6
    case Reset_Content = 205;
    // RFC7233, Section 4.1
    case Partial_Content = 206;
    // RFC4918
    case Multi_Status = 207;
    // RFC5842
    case Already_Reported = 208;
    // RFC3229
    case IM_Used = 226;

    // RFC7231, Section 6.4.1
    case Multiple_Choices = 300;
    // RFC7231, Section 6.4.2
    case Moved_Permanently = 301;
    // RFC7231, Section 6.4.3
    case Found = 302;
    // RFC7231, Section 6.4.4
    case See_Other = 303;
    // RFC7232, Section 4.1
    case Not_Modified = 304;
    // RFC7231, Section 6.4.5
    case Use_Proxy = 305;
    // RFC7231, Section 6.4.6
    case Explicitly_Unused = 306;
    // RFC7231, Section 6.4.7
    case Temporary_Redirect = 307;
    // RFC7538
    case Permanent_Redirect = 308;

    // RFC7231, Section 6.5.1
    case Bad_Request = 400;
    // RFC7235, Section 3.1
    case Unauthorized = 401;
    // RFC7231, Section 6.5.2
    case Payment_Required = 402;
    // RFC7231, Section 6.5.3
    case Forbidden = 403;
    // RFC7231, Section 6.5.4
    case Not_Found = 404;
    // RFC7231, Section 6.5.5
    case Method_Not_Allowed = 405;
    // RFC7231, Section 6.5.6
    case Not_Acceptable = 406;
    // RFC7235, Section 3.2
    case Proxy_Authentication_Required = 407;
    // RFC7231, Section 6.5.7
    case Request_Timeout = 408;
    // RFC7231, Section 6.5.8
    case Conflict = 409;
    // RFC7231, Section 6.5.9
    case Gone = 410;
    // RFC7231, Section 6.5.10
    case Length_Required = 411;
    // RFC7232, Section 4.2RFC8144, Section 3.2
    case Precondition_Failed = 412;
    // RFC7231, Section 6.5.11
    case Payload_Too_Large = 413;
    // RFC7231, Section 6.5.12
    case Request_URI_Too_Long = 414;
    // RFC7231, Section 6.5.13RFC7694, Section 3
    case Unsupported_Media_Type = 415;
    // RFC7233, Section 4.4
    case Requested_Range_Not_Satisfiable = 416;
    // RFC7231, Section 6.5.14
    case Expectation_Failed = 417;
    // RFC2324
    case Im_a_teapot = 418;
    // RFC7540, Section 9.1.2
    case Misdirected_Request = 421;
    // RFC4918
    case Unprocessable_Entity = 422;
    // RFC4918
    case Locked = 423;
    // RFC4918
    case Failed_Dependency = 424;
    // RFC8470
    case Too_Early = 425;
    // RFC7231, Section 6.5.15
    case Upgrade_Required = 426;
    // RFC6585
    case Precondition_Required = 428;
    // RFC6585
    case Too_Many_Requests = 429;
    // RFC6585
    case Request_Header_Fields_Too_Large = 431;
    // RFC7725
    case Unavailable_For_Legal_Reasons = 451;

    // RFC7231, Section 6.6.1
    case Internal_Server_Error = 500;
    // RFC7231, Section 6.6.2
    case Not_Implemented = 501;
    // RFC7231, Section 6.6.3
    case Bad_Gateway = 502;
    // RFC7231, Section 6.6.4
    case Service_Unavailable = 503;
    // RFC7231, Section 6.6.5
    case Gateway_Timeout = 504;
    // RFC7231, Section 6.6.6
    case HTTP_Version_Not_Supported = 505;
    // RFC2295
    case Variant_Also_Negotiates = 506;
    // RFC4918
    case Insufficient_Storage = 507;
    // RFC5842
    case Loop_Detected = 508;
    // RFC2774
    case Not_Extended = 510;
    // RFC6585
    case Network_Authentication_Required = 511;

    /**
     * Returns the human-friendly message version of the status code.
     *
     * These message strings are defined by the RFC that defined the code. In omst
     * cases it is the same as the enum value name, give or take a little formatting.
     *
     * @return string
     */
    public function message(): string
    {
        // A few need special handling because of non-alphabetic characters.
        // The rest are a trivial string transformation.
        return match ($this) {
            self::Non_Authoritative_Information => 'Non-authoritative Information',
            self::Multi_Status => 'Multi-Status',
            self::Im_A_Teapot => "I'm A Teapot",
            self::Request_URI_Too_Long => "Request-URI Too Long",
            default => str_replace('_', ' ', $this->name),
        };
    }

    /**
     * Determines what category of message this status code is.
     *
     * @return StatusCategory
     */
    public function category(): StatusCategory
    {
        return match(floor($this->value / 100)) {
            1 => StatusCategory::Informational,
            2 => StatusCategory::Success,
            3 => StatusCategory::Redirection,
            4 => StatusCategory::ClientError,
            5 => StatusCategory::ServerError,
        };
    }

}
