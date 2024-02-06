<?php

namespace Koba\ToolboxClient\Scopes;

enum Scope: string
{
    case STATISTIEKEN = 'statistieken';
    case CONTACTPERSONEN = 'contactpersonen';
    case INSTELLINGSNUMMERS = 'instellingsnummers';
}
