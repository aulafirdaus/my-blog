<?php

namespace App\Enums;

enum ArticleStatus: int
{
    case PENDING = 0;
    case PUBLISHED = 1;
    case ARCHIVED = 2;
}