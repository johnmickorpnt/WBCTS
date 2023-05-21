<?php
class Modal{
    private $id, $header, $content, $styles, $class, $attributes, $height, $width, $contentCss;
    

    public function __construct($id)
    {
        $this -> id = $id;
    }

    public function build_modal(){
        $classList = $this->getClass() !== null ? " " . implode(" ", $this->getClass()) : "";
        $class = "class='modal{$classList}'";

        $contentCssList = $this->getContentCss() !== null ? " " . implode(";", $this->getContentCss()) : "";
        $contentCss = "style='{$contentCssList}'";

        $modalStyles = $this->getStyles() !== null ? implode(";", $this->getStyles()) : "";
        $modalCss = "style='{$modalStyles}'";
        
        $attrbs = $this->getAttributes() !== null ? " " . implode(" ", $this->getAttributes()) : "";
        $content = <<<CONTENT
        <dialog id="{$this->getId()}" {$class}{$attrbs}{$modalCss}>
            <div class="modal-wrapper">
                <div class="modal-header">
                    <h4>{$this->getHeader()}</h4>
                    <div class="close-modal">
                        <i class="fa-solid fa-x"></i>
                    </div>
                </div>
                <div class="modal-content"{$contentCss}>
                    {$this->getContent()}
                </div>
            </div>
        </dialog>
        CONTENT;
        return $content;
    }
    /**
     * Get the value of header
     */ 
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of styles
     */ 
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set the value of styles
     *
     * @return  self
     */ 
    public function setStyles($styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get the value of class
     */ 
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the value of class
     *
     * @return  self
     */ 
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of attributes
     */ 
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */ 
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of width
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of contentCss
     */ 
    public function getContentCss()
    {
        return $this->contentCss;
    }

    /**
     * Set the value of contentCss
     *
     * @return  self
     */ 
    public function setContentCss($contentCss)
    {
        $this->contentCss = $contentCss;

        return $this;
    }
}
