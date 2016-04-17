# China-Economy-Classification
A PHP library to get the GB/5754 codes.

China National Economy Classification Codes 国民经济行业分类与代码 GB/4754-2011

## Installation
```
composer require wispiring/china-economy-classification
```
## Usage
```php
$classification = new \Wispiring\ChinaEconomyClassification\Classification();

// Get array of all the codes
$data = $classification->getArray();

// Get by code
$data = $classification->getByCode('0141');

// Get by name
$data = $classification->getByName('超级市场零售');

// Get codes by category
$data = $classification->getByTopCategory('A');
$data = $classification->getByFirstCategory('51');
$data = $classification->getBySecondCategory('389');
$data = $classification->getByThirdCategory('0141');

```
## License

This software is licensed under the [MIT License](LICENSE).
