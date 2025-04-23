<?php

namespace Perception\Libraries\Html\Builder;

use Collective\Html\FormBuilder as CollectiveFormBuilder;

class FormBuilder extends CollectiveFormBuilder
{
    /**
     * Create a checkbox input field.
     *
     * @param  string $name
     * @param  mixed  $value
     * @param  bool   $checked
     * @param  array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        $labelHtml = $this->label($options['id'] ?? $name, $options['label'] ?? ' ');

        if (isset($options['label'])) {
            unset($options['label']);
        }

        $checkboxHtml = $this->checkable('checkbox', $name, $value, $checked, $options);

        return $this->toHtmlString('<div class="' . config('constants.icheck-class') . '">' . $checkboxHtml . $labelHtml . '</div>');
    }

    /**
     * Create a radio button input field.
     *
     * @param  string $name
     * @param  mixed  $value
     * @param  bool   $checked
     * @param  array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function radio($name, $value = null, $checked = null, $options = [])
    {
        if (is_null($value)) {
            $value = $name;
        }

        $labelHtml = $this->label($options['id'] ?? $name, $options['label'] ?? ' ');

        if (isset($options['label'])) {
            unset($options['label']);
        }

        $radioHtml = $this->checkable('radio', $name, $value, $checked, $options);

        $class = config('constants.icheck-class');
        if (isset($options['wrapper-class'])) {
            $class .= ' ' . $options['wrapper-class'];
        }

        return $this->toHtmlString('<div class="' . $class . '">' . $radioHtml . $labelHtml . '</div>');
    }

    /**
     * Create a select box field.
     *
     * @param  string $name
     * @param  array  $list
     * @param  string|bool $selected
     * @param  array  $selectAttributes
     * @param  array  $optionsAttributes
     * @param  array  $optgroupsAttributes
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $attributes = $selectAttributes;

        if (isset($selectAttributes['ajax-url'])) {
            unset($selectAttributes['ajax-url']);
        }

        if (isset($selectAttributes['ajax-data'])) {
            unset($selectAttributes['ajax-data']);
        }

        if (isset($selectAttributes['ajax-allowclear'])) {
            unset($selectAttributes['ajax-allowclear']);
        }

        $select = parent::select($name, $list, $selected, $selectAttributes, $optgroupsAttributes, $optgroupsAttributes);
        if (isset($attributes['ajax-url'])) {
            $script = view('components.select2_ajax', ['name' => $name, 'list' => $list, 'selected' => $selected, 'attributes' => $attributes])->render();
            return $select . $script;
        }
        return $select;
    }

    /**
     * Create a textarea input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function textarea($name, $value = null, $options = [])
    {
        $this->type = 'textarea';

        $rte = false;
        if (isset($options['richtexteditor'])) {
            // isset($options['class']) ? $options['class'] . ' d-none' : 'd-none';
            $rte = true;
        }

        if (!isset($options['name'])) {
            $options['name'] = $name;
        }

        // Next we will look for the rows and cols attributes, as each of these are put
        // on the textarea element definition. If they are not present, we will just
        // assume some sane default values for these attributes for the developer.
        $options = $this->setTextAreaSize($options);

        $options['id'] = $this->getIdAttribute($name, $options);

        $value = (string) $this->getValueAttribute($name, $value);

        unset($options['size'], $options['richtexteditor']);

        // Next we will convert the attributes into a string form. Also we have removed
        // the size attribute, as it was merely a short-cut for the rows and cols on
        // the element. Then we'll create the final textarea elements HTML for us.
        $options = $this->html->attributes($options);

        $textarea = $this->toHtmlString('<textarea' . $options . '>' . e($value, false) . '</textarea>');
        if ($rte) {
            $textarea .= view('components.richtexteditor', ['name' => $name])->render();
        }
        return $textarea;
    }
}
