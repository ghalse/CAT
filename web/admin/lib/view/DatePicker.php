<?php
namespace lib\view;

use lib\view\html\HtmlElement;
use lib\view\html\UnaryTag;
use lib\view\html\CompositeTag;

/**
 * 
 * @author Zilvinas Vaira
 *
 */
class DatePicker implements HtmlElement, PageElement{
    
    const BLOCK_CLASS = 'sb-date-container';
    const INPUT_CLASS = 'sb-date-picker';
    
    /**
     * Counts DatePicker objects to generate id's
     * @var int
     */
    private static $COUNT = 0;
    
    /**
     * Input element id
     * 
     * @var string
     */
    private $id = '';
    /**
     * Input element name
     * @var string
     */
    private $name = '';
    /**
     * Input element format template for the date value
     * @var string
     */
    private $format = '';
    
    /**
     * 
     * @param string $name Name of an input element
     * @param string $format Defines a format template for the date value
     */
    public function __construct($name, $format='yyyy-MM-dd'){
        self::$COUNT++;
        $this->id = self::INPUT_CLASS.'-'.self::$COUNT;
        $this->name = $name;
        $this->format = $format;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \lib\view\PageElement::render()
     */
    public function render(){
        ?>
        <div class=<?php echo self::BLOCK_CLASS; ?>>
            <input id="<?php echo $this->id; ?>" class="<?php echo self::INPUT_CLASS; ?>" type="date" name="<?php echo $this->name; ?>" value="<?php echo $this->format; ?>" maxlength="10">
        </div>
        <?php
    }
    
    public function __toString(){
        $div = new CompositeTag('div');
        $div->addAttribute('class', self::BLOCK_CLASS);
            $input = new UnaryTag('input');
            $input->addAttribute('type', 'date');
            $input->addAttribute('maxlength', 10);
            $input->addAttribute('id', $this->id);
            $input->addAttribute('class', self::INPUT_CLASS);
            $input->addAttribute('name', $this->name);
            $input->addAttribute('value', $this->format);
        $div->addTag($input);
        return $div->__toString();
    }
    
}