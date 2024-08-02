<?php

namespace App\Services\DashboardResource;

enum TypeColumn:string
{
    case TEXT = "text";
    case TEXTAREA = "textarea";
    case NUMBER = "number";
    case DATE = "date";
    case PHOTO = "file";
    case SELECT = "select";
}
