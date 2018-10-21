<?php

return [
    'alipay' => [
        'app_id'         => '2016091600527744',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxC3kzeuCw2KHmNXq9G4vBxX2NSCT0UdAn5zgEe+tRIxtJs+bxCgZg1CWN2cUHuBLaj0v9RgqGsV8yOa4np/HgiGmUkUo1ZFyx1XxJjGuXkFO7X2vJgIdSiM8Q8uBjec9rcmYgJbCQimvUPvOXaXWN/dgZdmbvwwXCcpJk+n8YIQno0mW3zjN/aNLgXvx9WOjW7tUxLswOImY+Ahqd17qVEAH2Z2Q4/fkMeZ+/zrSY1gQgRdzrIxJEPBBvr0WMzbWsZZmbs82T6YKsPWYIEjL9Jfh7hCbDKz06ZbQJbkiUcLVQy+Prp0vZbzYHQPvOmEufU1e+BkjLMOK5PFNFgoLhQIDAQAB',
        'private_key'    => 'MIIEpQIBAAKCAQEAqz3w0FORKG924caujGs3H2f2NBfwfuHQfq/duXIU4hkxgiMYr0m4AJ9n2pzAuMN1qzXt75ZwMovyikXjg7+8cpueSlPUU+vrW6J7ri/SUVpOvXA/I9RsF0LQYwQxI/sRIMX+7Y6tgO0zpT+BGSTmp6WKC8iXP00xg30/JLCKy6frHXXQ5TxHFZPBGQxahA5eOfjnhKAVzj+K/8r0MfCOIambQqUieJpHT+h5sDFZxLy2Dqlw7/wz6KM/jzREnAT+iBp4sRnKgnhXeuNRgHskx7hrcxLlZWOr2TijB4tbUBi871Hvu/7+NOrlhwMpMYazAjkLW3fX1KaQF8h4MXgSKwIDAQABAoIBAQCFATRFK1NI2+KzlJVInZIQA7i4V4vFkXFWpRSLkG9l+fl5QfdPVuvjF+0bYLtUBwUjOV0YxXlZ2VdGTOhdEZS2U+bLhncZw9lnsDluXth1tbYI7+Eq3DgkjRG8hqoAb2arVP4f170tsY92n2+Pbxj0R+CELIZFdZiqr6JWxgTYDsxm0lLvQefEI6MBA28HYk4XjWZay7gtNQUIvzhmtsvahjiBNGqCEv4jBQ/yWlaEA9YNJKoYvXnlKmixLpKFyIt2ESCI7eTPEf419EIlZejuwiQE85Foe+laumx1/Ox4QYbh1jxiJO88QYsCsDEIyZAN2mTFPGx5dV4o4EEQpOqpAoGBANgVANAg0roSK5v6Nf/sbAqnCgEj5ZERnXP5oV30LWWYGBK6sUcGG2R9owMSFowCNLod8m7Lv/kGPl3eZ6hBw4rndgNaorDBvFt/1Vv17XEsLN4zojKCl047BcK+7hq5Qw8WF7yRw3/5pZLDyRU12kpFmp/7GxqLTRQas8Z3lQB1AoGBAMrgWcvgpZqkY3y9j5P/CD7LTDYvT8JlFuBNhSWy4Xdgy+6TbKyrHyJwusJI0YyqX9IiBG0evZPAa6Q7LPYNFSnd2DC/5lJzssyzogR6xtdlmMjc+Jmt8Kl8H0bGsEzuDPWFwe+mxKlw9Auk1u8wlRg83ZKZzfPb0eoyWQaiWHQfAoGAQAXpGcG/7jXYCf0W5t9MG9PmWPQj3tnTRzudnlLs6H8qEtKSGDMtBpdbJ1vCpnU43jRlUoK4PLam3/U3zVi+8XcnNlMyhSDCCHJV60twsOmf2a5+zmx3HEzMpikgL3bY8a1gFxUxUcfMUTIFcG1mYj9BU0l5fGHt0pkezx07XskCgYEAobbT3T/kwa/n3bb8i+vulp9W0JpF6Z7K7WDdkX9VWeM+q524Mqr01m8lb1i8MHRejRGwlYq7ctse8np5DGjBRe4gNjvBTFgNXj6SFyAHAAtsDjCVuWp9O5xFEhWu0qOukMdeH7m/aZEv91geO+tt7TQXKpSPJqNCYHxhmnguKeECgYEAgOmHrGdoI420YXaJ0vx/OROuHbGZgcUDtNEpE0lzzEtJdXPjuhPblZKrWJOaQ4uh/ul7LxYOPKxrHnS+stv8vTqkCKM+tJtEOu6PMQAGPq8o5CxwBkkGesj2glzr5sVLQFHBlreN47vcB4pU0vGksQJ9GaWVn0yVItZb2i6GRhY=',
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