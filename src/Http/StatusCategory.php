<?php
declare(strict_types=1);

namespace Crell\EnumTools\Http;

enum StatusCategory
{
    case Informational;
    case Success;
    case Redirection;
    case ClientError;
    case ServerError;
}
