# PHP Google Calendar

## Start Server 
```shell
php -S localhost:8000 
```

## Google Calendar Api Configuration
You will need to put a credentials.json file inside `config` folder for the application to work properly.

### Example Configuration

```json
{
    "web": {
        "client_id": "300305135676-sitpobcf9q7rfh6trhbtoni001l68trl.apps.googleusercontent.com",
        "project_id": "numeric-trilogy-430604-q2",
        "auth_uri": "https://accounts.google.com/o/oauth2/auth",
        "token_uri": "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
        "client_secret": "client_secret",
        "redirect_uris": [
            "http://localhost:8000"
        ]
    }
}
```

**_Note:_** You can get your own Google Calendar Api credentials from the google api console. 
