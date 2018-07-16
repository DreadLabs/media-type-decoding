# dreadlabs/media-type-decoding

## Description

This library provides a simple API for [Media type](#def_media_type) decoding.

It can be used to infer PHP class names from Media type strings literals such as 
**application/prs.acme.user-created+json; version=1.0**.

This library leans on the [RFC 6838](#rfc_6838) specification.

It is a companion to [DreadLabs/media-type-encoding](https://github.com/DreadLabs/media-type-encoding),
providing decoding of a [Media type](#def_media_type) string literal.

## Installation

    composer install dreadlabs/media-type-decoding:~1.0

## Usage

Example 1

> From a Media type string literal within the **Application** top-level type and 
the **Vendor** subtype tree, I want to resolve a fully-qualified PHP class name.
The Media type string literal also carries a **version** parameter and no
*Suffix* is defined.

    $mediaType = new Application(RegistrationTree::vendor(new UpperCamelCasedFromHyphened(new Imploded('\\'))));
    $withParameter = $mediaType->withParameter(new Parameter('version'));
    $withSuffix = $withParameter->withSuffix(Suffix::none());
    
    echo (string)$withSuffix->inferred('application/vnd.acme.customer-api.domain.event.item-added-to-cart; version=1.0');
    
    > 'Acme\\CustomerApi\\Domain\\Event\\ItemAddedToCart'

Example 2

> This example enhances Example 1. The Media type string literal does not carry
all necessary data to get the fully-qualified PHP class name. So we make usage
of the *Prefixed* subtype inference.

    $prefix = ['acme', 'customer-api', 'domain'];
    $subtype = new Prefixed(new UpperCamelCasedFromHyphened(new Imploded('\\')), $prefix);
    $mediaType = new Application(RegistrationTree::personal($subtype));
    
    echo (string)$mediaType->inferred('application/prs.event.item-removed-from-cart')
    
    > 'Acme\\CustomerApi\\Domain\\Event\\ItemRemovedFromCart'

## Development

### Requirements

Please read the [contribution guide](CONTRIBUTING.md) and ensure you have a 
working Docker environment.

### Setup

Fork and clone this repository as described in the [contribution guide](CONTRIBUTING.md).

Open a terminal and run the setup script:

    script/setup

### Run tests

    script/console run composer test:unit
    script/console run composer test:integration
    script/console run composer test:acceptance:fail-fast

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
