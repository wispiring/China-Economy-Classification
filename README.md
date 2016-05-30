[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wispiring/China-Economy-Classification/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wispiring/China-Economy-Classification/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/wispiring/China-Economy-Classification/badges/build.png?b=master)](https://scrutinizer-ci.com/g/wispiring/China-Economy-Classification/build-status/master)

# China Economy Classification Codes
## 国民经济行业分类与代码

A PHP library to get the GB/5754 codes.

China National Economy Classification Codes GB/4754-2011.

国民经济行业分类与代码（GB/4754-2011），国民经济行业分类。

A 农、林、牧、渔业； B 采矿业； C 制造业； D 电力、热力、燃气及水生产和供应业； E 建筑业； F 批发和零售业； G 交通运输、仓储和邮政业； H 住宿和餐饮业； I 信息传输、软件和信息技术服务业； J 金融业； K 房地产业； L 租赁和商务服务业； M 科学研究和技术服务业； N 水利、环境和公共设施管理业； O 居民服务、修理和其他服务业； P 教育； Q 卫生和社会工作； R 文化、体育和娱乐业； S 公共管理、社会保障和社会组织； T 国际组织

《国民经济行业分类》国家标准于1984年首次发布，分别于1994年和2002年进行修订，2011年第三次修订。该标准（GB/T 4754-2011）由国家统计局起草，国家质量监督检验检疫总局、国家标准化管理委员会批准发布，并将于2011年11月1日实施。 此次修订除参照2008年联合国新修订的《国际标准行业分类》修订四版（简称：ISIC4）外，主要依据我国近年来经济发展状况和趋势，对门类、大类、中类、小类做了调整和修改。

新国家标准《国民经济行业分类》（GB/T4754-2011）经国家质量监督检验检疫总局、国家标准化管理委员会批准发布，并将于2011年11月1日实施。根据统计工作的实际情况，从2012年定报统一开始使用。

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
## Generating HTML select element
Examples can be found in the example dir
```php
# single select

$classification = new \Wispiring\ChinaEconomyClassification\Classification();
// passing the name of the select widget as parameter
echo $classification->getSelectWidget('cec');
// passing both the name and the selected value
echo $classification->getSelectWidget('cec', '3399');

# 4 select combo - the cec.js is required, no other JavaScript libs needed

$classification = new \Wispiring\ChinaEconomyClassification\Classification();

echo '<script>'.file_get_contents('../assets/cec.js').'</script>';

echo $classification->getSelectWidget4('cec', '1810');
echo $classification->getSelectWidget4('test', '7724');
echo $classification->getSelectWidget4('test2');

```
## Use in Symfony forms
```php
$classification = new \Wispiring\ChinaEconomyClassification\Classification();

// Get array for select html widget
$data = $classification->getSelectArray();

```
Please refer to the [concrete example](example/select.php).

## License

This software is licensed under the [MIT License](LICENSE).
