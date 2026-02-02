# Troubleshooting

This document lists common issues you may encounter when using
**reSmushIt for Laravel** and how to resolve them.

------------------------------------------------------------------------

## SSL certificate problem: unable to get local issuer certificate

### Symptoms

You may see an error similar to:

    SSL certificate problem: unable to get local issuer certificate

This occurs when PHP cannot locate a trusted Certificate Authority (CA)
bundle to verify HTTPS connections.

This issue is most common on **Windows-based environments** such as
WAMP, XAMPP, or custom PHP installations.

------------------------------------------------------------------------

### Root Cause

PHP's cURL and OpenSSL extensions require access to a CA certificate
bundle to validate HTTPS requests.\
If no CA bundle is configured, HTTPS requests to the reSmush.it API will
fail before the request is sent.

------------------------------------------------------------------------

### Recommended Fix (Safe & Production-Ready)

1.  Download the official CA bundle from the cURL project:
    https://curl.se/ca/cacert.pem

2.  Save the file to a permanent location, for example:

        D:\wamp\bin\php\extras\ssl\cacert.pem

3.  Locate the active `php.ini` file used by the CLI:

    ``` bash
    php --ini
    ```

4.  Edit the `php.ini` file and set the following values:

    ``` ini
    [curl]
    curl.cainfo = "D:\wamp\bin\php\extras\ssl\cacert.pem"

    [openssl]
    openssl.cafile = "D:\wamp\bin\php\extras\ssl\cacert.pem"
    ```

5.  Restart your web server and any running PHP processes.

After completing these steps, HTTPS requests to the reSmush.it API
should work correctly.

------------------------------------------------------------------------

### ⚠️ Important Security Note

Do **not** disable SSL verification in production by setting:

``` php
CURLOPT_SSL_VERIFYPEER => false
CURLOPT_SSL_VERIFYHOST => false
```

Disabling SSL verification exposes your application to man-in-the-middle
attacks and is not recommended.

------------------------------------------------------------------------

## Still Having Issues?

If the problem persists:

-   Ensure you edited the correct `php.ini` file (CLI vs web server)

-   Restart your terminal or IDE after configuration changes

-   Verify the CA file path using:

    ``` bash
    php -r "var_dump(openssl_get_cert_locations());"
    ```

If none of the above resolves the issue, please open an issue on GitHub
with details about your environment.
