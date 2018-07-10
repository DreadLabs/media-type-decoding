# dreadlabs/mediatype-decoding

## Description

This library provides a simple API for [Media type](#def_media_type) inference.

It can be used to infer PHP class names from Media type strings literals such as 
**application/prs.acme.user-created+json; version=1.0**.

This library leans on the [RFC 6838](#rfc_6838) specification, but is currently
not compatible in every detail.

## Installation

    composer install dreadlabs/mediatype-decoding:~1.0

## Usage

    $mediaType = new Application(RegistrationTree::personal(new HyphenedFromUpperCamelCased(new Exploded('\\'))));
    $withParameter = $mediaType->withParameter(new Parameter('version', '1.0'));
    $withSuffix = $withParameter->withSuffix(new Json());
    
    echo (string)$withSuffix->designated('Acme\\Example\\Class');
    
    > 'application/prs.acme.example.class+json; version=1.0'

## Links

  * [IANA Application for Media Types](#iana_application)
  * [registered IANA Media Types](#registered_media_types)
  * [IANA Structured Syntax Suffix Registry](#suffix_registry)
  
## License

[MIT](LICENSE)

[def_media_type]: https://en.wikipedia.org/wiki/Media_type
[iana_application]: https://www.iana.org/form/media-types
[registered_media_types]: https://www.iana.org/assignments/media-types/media-types.xhtml
[suffix_registry]: https://www.iana.org/assignments/media-type-structured-suffix/media-type-structured-suffix.xhtml
