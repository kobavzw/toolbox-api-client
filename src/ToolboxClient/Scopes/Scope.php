<?php

namespace Koba\ToolboxClient\Scopes;

enum Scope: string
{
    case STATISTIEKEN = 'statistieken';
    case CONTACTPERSONEN = 'contactpersonen';
    case INSTELLINGSNUMMERS = 'instellingsnummers';
    case INVENTARIS = 'inventaris';
    case VERHUURCONTRACTEN_GOEDKEUREN = 'verhuurcontracten.goedkeuren';
    case LERAREN = 'leraren';
    case LEERLINGEN = 'leerlingen';
    case GEBRUIKERSBEHEER = 'gebruikersbeheer';
}
