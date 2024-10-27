<?php
// app/Enums/LeaveType.php
namespace App\Enums;

enum PostType: string {
    case Business = 'Business';
    case Casual = 'Casual';
    case Crime = 'Crime';
    case Education = 'Education';
    case Entertainment = 'Entertainment';
    case Lifestyle = 'Lifestyle';
    case Politics = 'Politics';
    case Sports = 'Sports';

}
