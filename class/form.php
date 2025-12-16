<?php
/**
 * Nama Class: Form
 * Deskripsi: Class untuk membuat form inputan dinamis
 */
class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm()
    {
        echo "<form action='" . $this->action . "' method='POST' enctype='multipart/form-data'>";
        echo '<table width="100%" border="0">';
        foreach ($this->fields as $field) {
            echo "<tr><td align='right' valign='top'>" . $field['label'] . "</td>";
            echo "<td>";
            
            switch ($field['type']) {
                case 'textarea':
                    $value = isset($field['value']) ? $field['value'] : '';
                    echo "<textarea name='" . $field['name'] . "' cols='30' rows='4'>" . $value . "</textarea>";
                    break;
                case 'select':
                    echo "<select name='" . $field['name'] . "'>";
                    foreach ($field['options'] as $value => $label) {
                        $selected = (isset($field['value']) && $field['value'] == $value) ? 'selected' : '';
                        echo "<option value='" . $value . "' " . $selected . ">" . $label . "</option>";
                    }
                    echo "</select>";
                    break;
                case 'radio':
                    foreach ($field['options'] as $value => $label) {
                        $checked = (isset($field['value']) && $field['value'] == $value) ? 'checked' : '';
                        echo "<label><input type='radio' name='" . $field['name'] . "' value='" . $value . "' " . $checked . "> " . $label . "</label> ";
                    }
                    break;
                case 'checkbox':
                    foreach ($field['options'] as $value => $label) {
                        echo "<label><input type='checkbox' name='" . $field['name'] . "[]' value='" . $value . "'> " . $label . "</label> ";
                    }
                    break;
                case 'password':
                    echo "<input type='password' name='" . $field['name'] . "'>";
                    break;
                case 'file':
                    echo "<input type='file' name='" . $field['name'] . "'>";
                    break;
                case 'number':
                    $value = isset($field['value']) ? $field['value'] : '';
                    echo "<input type='number' name='" . $field['name'] . "' value='" . $value . "'>";
                    break;
                default:
                    $value = isset($field['value']) ? $field['value'] : '';
                    echo "<input type='text' name='" . $field['name'] . "' value='" . $value . "'>";
                    break;
            }
            echo "</td></tr>";
        }
        echo "<tr><td colspan='2'>";
        echo "<input type='submit' value='" . $this->submit . "'></td></tr>";
        echo "</table>";
        echo "</form>";
    }

    public function addField($name, $label, $type = "text", $options = array(), $value = '')
    {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->fields[$this->jumField]['type'] = $type;
        $this->fields[$this->jumField]['options'] = $options;
        $this->fields[$this->jumField]['value'] = $value;
        $this->jumField++;
    }
}
?>