# Redirect exception

**Enable feature**

```yaml
{# config/packages/sfs_core.yaml #}
sfs_core:
    http:
        catch_http_redirect_exception: true        
```

**Usage**

```php
use Softspring\CoreBundle\Http\HttpRedirectException;
use Symfony\Component\HttpFoundation\RedirectResponse;

throw new HttpRedirectException(new RedirectResponse('/redirect-url'));        
```

Automatically, a listener catches the exception and sets the response.