<?php

return [
    'alipay' => [
        'app_id'         => '2016091600527744',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxC3kzeuCw2KHmNXq9G4vBxX2NSCT0UdAn5zgEe+tRIxtJs+bxCgZg1CWN2cUHuBLaj0v9RgqGsV8yOa4np/HgiGmUkUo1ZFyx1XxJjGuXkFO7X2vJgIdSiM8Q8uBjec9rcmYgJbCQimvUPvOXaXWN/dgZdmbvwwXCcpJk+n8YIQno0mW3zjN/aNLgXvx9WOjW7tUxLswOImY+Ahqd17qVEAH2Z2Q4/fkMeZ+/zrSY1gQgRdzrIxJEPBBvr0WMzbWsZZmbs82T6YKsPWYIEjL9Jfh7hCbDKz06ZbQJbkiUcLVQy+Prp0vZbzYHQPvOmEufU1e+BkjLMOK5PFNFgoLhQIDAQAB',
        'private_key'    => 'MIIEogIBAAKCAQEAyt6u/Xseol4viV1RipeGUmd5YOAQg8bd+z/GS5vot3Ch4Q4Sy0hF4LWZWJ7pN6kHJKWTQQHEwkD51ixkfQYckd09k6rDjCFUPwdlqNL960wpEOhQgt1ZZBFV/PcL/mrVSzgUAb76DJbkc7hxrcXFDqZmrU76ThscLfK0TkStSxGL7ChnCy9F0V7YvH7L4aPUNSmxXt0aGc/tiLz5NCB7+AlLHJx9nIq+9hdFSfO9D+AdU02WKOchbxVsPmRPgEAPRMu4Z2yxQow9II6ZLjp6Rr5E1sqTv7HacrTyHCvI4XKxXR8JEeGqs1mEbAFMMSOs2xCnAxm6tcFGggRfV67UAwIDAQABAoIBAECgvEKITHQRaTdrgSSTrPjneeWAvAIfAmyeHn/LxVFbElbt8tLLzWcOszFmPom60Um9bbHR7Gqt5Gl0bvbdUZCuWIWIaw9jNsF1i89CmB2zf4mhWLS361hTpX8W/L0qL5Ts4oLD4kjMcS7kXWKslGBcZm1jsZ3cSRfiL8qXWlWFSaIQ5wD47+rp/Ppj3waB45PARaF8/yaw1eSJI+UZAnwW491ZQzIw7/BPyYaRKYhqu4r0APQ49TmF68lrIh6Syk1NFer6X3iW/A41SE5ZZKUFzaHwYIQNeJia49Qx2P3mUYrp9iHiq1GXebi6HhkaLlEu/QSn0NOCtwltfiYbnoECgYEA+oUeRuBcmPKS6PvdROYb0t0IAboTdZhAa1QDRe1ADtmEc2nLdgG+xK1eeDs5HldpBSdNDcuTIj/dyLmzwwzZu5g1L3l+SNa94JZ69+0jBrEGNbKI6R5/FnUizRfEpJIrj/f8bvdLgTfjHt0wEwgWxfCTnSyKa0GcudthUSYLEWECgYEAz06683AmwVMcxF2rJcqlFsg64RX65v4wU3jWuxKIV95TAvRzr9eQbubzSpatq6ADGWCcQe42rG+/uki+PQXkOChjx+3nN48EIiizyTthn2cxS382uTdB3TMcn3+Wh/ORlyQ0BnmIC9rTB7RKgYndje2izVGVZgYDgnjSGLgnS+MCgYA4eItjpK2a2ItfM28kWc6J0MM+SGiciG51AyIdwCZBcqzVq1JuzmPnR8FUztzIRyHoRHytEGehP85JsfqgjCQEkoHiqrtZxfZVSvZ7LpxHpN3metE742D4ef0XSDVOd5iUQm1Hwjzl6ugqi+eLUrZ3dgyAUIr/NHIUvywHs9Co4QKBgDlDfyK1jQ8D3UNkuFz1EAst/g2k26yo9EJqc64zHVRgRj/ftIETI4Nu6i9lVc29on2FEUSo/5M8PxK++0Wx9euJRJ66WY8gQz0ITzk73OiCQbygBEa/O8NVVge836DoKAQ+7NwJAAp+RKKxK4+CvJ9yz/C1I3aOHLQSmb5YSAqPAoGALD2eSUoT6MkpzE+dF2TziThitzzqCu85+m8tOpDxIuLmUkuYKKcDLa1UyNAn615Ar6V0Kc8kx2m4bxADKfqXqiO+z6I1uFYHZ95Q3uQpKOofHSRnQqBktiCiXI2e9K96hsM1szr76mm6FtbtrN7S9pOEgWdHp+uDVKOrRK48nSI=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];