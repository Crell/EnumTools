<?php
declare(strict_types=1);

namespace Crell\EnumTools\Http;

enum Method: string
{
    // RFC3744, Section 8.1
    case ACL = 'ACL';
    // RFC3253, Section 12.6
    case BASELINE_CONTROL = 'BASELINE-CONTROL';
    // RFC5842, Section 5842, Section 4
    case BIND = 'BIND';
    // RFC3253, Section 4.4, Section 9.4
    case CHECKIN = 'CHECKIN';
    // RFC3253, Section 4.3, Section 8.8
    case CHECKOUT = 'CHECKOUT';
    // RFC7231, Section 4.3.9
    case CONNECT = 'CONNECT';
    // RFC4918, Section 9.8
    case COPY = 'COPY';

    // RFC7231, Section 4.3.5
    case DELETE = 'DELETE';
    // RFC7231, Section 4.3.1
    case GET = 'GET';
    // RFC7231, Section 4.3.2
    case HEAD = 'HEAD';
    // RFC3253, Section 8.2
    case LABEL = 'LABEL';
    // RFC2068, Section 19.6.1.2
    case LINK = 'LINK';
    // RFC4918, Section 9.10
    case LOCK = 'LOCK';
    // RFC3253, Section 11.2
    case MERGE = 'MERGE';
    // RFC3253, Section 13.5
    case MKACTIVITY = 'MKACTIVITY';
    // RFC4791, Section 5.3.1.  RFC8144, Section 2.3.
    case MKCALENDAR = 'MKCALENDAR';
    // RFC4918, Section 9.3.  RFC5689, Section 3.  RFC8144, Section 2.3.
    case MKCOL = 'MKCOL';
    // RFC4437, Section 6
    case MKREDIRECTREF = 'MKREDIRECTREF';
    // RFC3253, Section 6.3
    case MKWORKSPACE = 'MKWORKSPACE';
    // RFC4918, Section 9.9
    case MOVE = 'MOVE';
    // RFC7231, Section 4.3.7
    case OPTIONS = 'OPTIONS';
    // RFC3648, Section 7
    case ORDERPATCH = 'ORDERPATCH';
    // RFC5789, Section 2
    case PATCH = 'PATCH';
    // RFC7231, Section 4.3.3
    case POST = 'POST';
    // RFC7540, Section 3.5
    case PRI = 'PRI';
    // RFC4918, Section 9.1.  RFC8144, Section 2.1.
    case PROPFIND = 'PROPFIND';
    // RFC4918, Section 9.2.  RFC8144, Section 2.2.
    case PROPPATCH = 'PROPPATCH';
    // RFC7231, Section 4.3.4
    case PUT = 'PUT';
    // RFC5842, Section 6
    case REBIND = 'REBIND';
    // // RFC3253, Section 3.6.  RFC8144, Section 2.1
    case REPORT = 'REPORT';
    // RFC5323, Section 2
    case SEARCH = 'SEARCH';
    // RFC7231, Section 4.3.8
    case TRACE = 'TRACE';
    // RFC5842, Section 5
    case UNBIND = 'UNBIND';
    // RFC3253, Section 4.5
    case UNCHECKOUT = 'UNCHECKOUT';
    // RFC2068, Section 19.6.1.3
    case UNLINK = 'UNLINK';
    // RFC4918, Section 9.11
    case UNLOCK = 'UNLOCK';
    // RFC3253, Section 7.1
    case UPDATE = 'UPDATE';
    // RFC4437, Section 7
    case UPDATEREDIRECTREF = 'UPDATEREDIRECTREF';
    // RFC3253, Section 3.5
    case VERSION_CONTROL = 'VERSION-CONTROL';

    /**
     * Determines if this method is considered safe.
     *
     * A safe method is one that does not have user-affecting side-effects
     * other than information retrieval.
     *
     * @return bool
     */
    public function isSafe(): bool
    {
        return match ($this) {
            self::GET, self::HEAD, self::OPTIONS, self::PRI, self::PROPFIND, self::REPORT, self::SEARCH, self::TRACE => true,
            default => false;
        };
    }

    /**
     * Determines if this method is idempotent.
     *
     * A method is idempotent if issuing the same command multiple times
     * will result in the same end condition each time.
     *
     * @return bool
     */
    public function isIdempotent(): bool
    {
        return match ($this) {
            self::CONNECT, self::LOCK, self::PATCH, self::POST => false,
            default => true,
        };
    }
}
