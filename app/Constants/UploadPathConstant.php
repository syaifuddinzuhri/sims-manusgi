<?php

namespace App\Constants;

class UploadPathConstant
{
    const UPLOAD_DIR = 'uploads/';
    const USER_PHOTOS = self::UPLOAD_DIR . 'user-photos';
    const TEST = self::UPLOAD_DIR . 'test';
    const STUDENT_IMPORT = self::UPLOAD_DIR . 'student-imports';
}
