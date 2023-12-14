# Languages  

*mibo/languages*

The library provides a simple interface for a language entity and language provider, which retrieves
a language by its ISO 639 alpha-2 code, alpha-3 code, alpha-3/B code.  
If the provider does not find the language, it throws an exception.

The Language entity contains its name, ISO 639-1 alpha-2 code, 639-2 alpha-3 code (639-2/T), 639-2/B code, and
the language's name.

The list of the available languages can be changed by the provider, because the library (ISO) provider
allows the dev to insert his/her own array of languages.

```php
$provider = new \MiBo\Languages\ISO\LanguageProvider($myLanguageList ?? []);

$lang = $provider->getByAlpha2('sk');

echo $lang->getName(); // Slovak
echo $lang->getAlpha2(); // sk
echo $lang->getAlpha3(); // slk
echo $lang->getAlpha3T(); // slk
echo $lang->getAlpha3B(); // slo
```
