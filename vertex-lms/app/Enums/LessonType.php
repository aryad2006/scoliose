<?php

namespace App\Enums;

enum LessonType: string
{
    case VIDEO = 'video';
    case TEXT = 'text';
    case IMAGE = 'image';
    case QUIZ = 'quiz';
    case SIM3D = 'sim3d';
}
