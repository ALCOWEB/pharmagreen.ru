<?php
namespace shop\forms\manage\Shop;
use shop\entities\Shop\Category;
use shop\entities\Shop\Characteristic;
use yii\base\Model;
use shop\helpers\CharacteristicHelper;

/**
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $type;
    public $uom;
    public $required;
    public $default;
    public $slug;
    public $textVariants;
    public $sort;
    public $categories;
    private $_characteristic;
    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            $this->name = $characteristic->name;
            $this->slug = $characteristic->slug;
            $this->type = $characteristic->type;
            $this->uom = $characteristic->uom;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;
            $this->categories = array_map(function($category) {return $category->id;}, $characteristic->categories);
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }
    public function rules(): array
    {
        return [
            [['name', 'type', 'sort', 'slug'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants', 'uom'], 'string'],
            [['categories'], 'safe'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }
    public function typesList(): array
    {
        return CharacteristicHelper::typeList();
    }

    public function getCategoriesList(): array{
        $result = array_column(array_map(function($category) {return ['id' => $category->id, 'name' => $category->name];}, Category::find()->where(['<>', 'slug', 'root'])->all()), 'name', 'id');
       return $result;
    }

    public function getVariants(): array
    {
        //return preg_split('#\s+#i', $this->textVariants);
        return preg_split('#[\r\n]+#i', $this->textVariants);
    }
}
