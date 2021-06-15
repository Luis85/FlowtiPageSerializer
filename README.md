# FlowtiPageSerializer
A serializer module for ProcessWire Pages.
This module will add a new method to all pages, called serializer which returns JSON.

## Dependecies

- symfony/serializer
- symfony/property-access

## Requirements

- ProcessWire 3.x
- Composer

## Installation

- cd /site/modules
- git clone git@github.com:Luis85/FlowtiPageSerializer.git
- cd FlowtiPageSerializer
- composer install

## Usage

calling $page->serialize() will return the serialized Page Object as a JSON string representation containing all accessable fields

calling $page->serialize('field_name') returns the Page Object with just this field

calling $page->serialize(['field1', 'field2']) will return the choosen fields
