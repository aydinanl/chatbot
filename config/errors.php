<?php

return [
    'INVAILD_STATUS' => [
        'message' => 'Geçersiz durum',
        'status' => 401,
        'code' => 00000
    ],
    'UNKNOWN_ERROR' => [
        'message' => 'Bilinmeyen Hata.',
        'status' => 404,
        'code' => 00000
    ],
    'NOT_FOUND' => [
        'message' => 'Bulunamadı.',
        'status' => 404,
        'code' => 00000
    ],

    /* User Hataları
     * 10000 */
    'USER_NOT_FOUND' => [
        'message' => 'Kullanıcı bulunamadı.',
        'status' => 404,
        'code' => 100404
    ],
    'USER_NOT_DELETED' => [
        'message' => 'Kullanıcı silinemedi.',
        'status' => 400,
        'code' => 100400
    ],
    'USER_LOGIN_WRONG' => [
        'message' => 'Kullanıcı adı veya şifre hatalı.',
        'status' => 401,
        'code' => 101404
    ],
    'USER_LOGIN_EMPTY' => [
        'message' => 'Kullanıcı adı veya şifre boş bırakılmamalıdır.',
        'status' => 404,
        'code' => 101404
    ],
    'USER_UNAUTHORIZED' => [
        'message' => 'Yetkiniz bulunmamaktadır.',
        'status' => 401,
        'code' => 100401
    ],
    'USER_DONE_EXAM' => [
        'message' => 'Daha önceden sınav olmuşsunuz.',
        'status' => 401,
        'code' => 100401
    ],

    /* Token Hataları
     * 102000 */
    'INVALID_CREDENTIALS' => [
        'message' => 'Geçersiz bilgiler.',
        'status' => 401,
        'code' => 102401
    ],
    'COULD_NOT_CREATE_TOKEN' => [
        'message' => 'Token üretilemedi.',
        'status' => 500,
        'code' => 102501
    ],
    'TOKEN_EXPIRED' => [
        'message' => 'Token süresi dolmuş.',
        'status' => 400,
        'code' => 102400
    ],
    'TOKEN_INVALID' => [
        'message' => 'Geçersiz token.',
        'status' => 406,
        'code' => 102406
    ],
    'TOKEN_ABSENT' => [
        'message' => 'Token bulunamadı.',
        'status' => 404,
        'code' => 102404
    ],
    /* Question Hataları
    * 000000 */
    'SUB_CAT_REQUIRED' => [
        'message' => 'Sub categori gereklidir.',
        'status' => 404,
        'code' => 000000
    ],
];