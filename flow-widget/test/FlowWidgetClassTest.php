<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * @covers FlowWidgetClass
 */
class FlowWidgetClassTest extends TestCase
{

    /**
     * @before
     */
    public function setUp(): void
    {
        $this->wp_cw_src = "https://customerwidget.joinflow.com/tvx-customer-widget-app.js";
        $this->wp_cw_widget_id = "0b1f2018-e44a-4422-b392-3e1a46dc82dc";

    }

    public function testScriptIsSet()
    {
        $wp_cw_script = "<script id=\"flow-widget\" src=\"" . $this->wp_cw_src . "\" charset=\"utf-8\" crossorigin=\"anonymous\" data-widget-id=\"" . $this->wp_cw_widget_id . "\" type=\"text/javascript\" defer></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $actualResult = $flowWidgetClass->getScript();

        $this->assertEquals($wp_cw_script, $actualResult);
    }

    public function testLegacyDataWidgetIdIsSet()
    {
        $wp_cw_script = "<script id=\"flow-widget\" src=\"" . $this->wp_cw_src . "\" charset=\"utf-8\" crossorigin=\"anonymous\" data-widget-id=\"" . $this->wp_cw_widget_id . "\" type=\"text/javascript\" defer></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $actualResult = $flowWidgetClass->getWidgetId();

        $this->assertEquals($this->wp_cw_widget_id, $actualResult);
    }

    public function testGETWidgetIdIsSet()
    {
        $wp_cw_script = "<script id=\"flow-widget\" src=\"" . $this->wp_cw_src . "?widgetId=" . $this->wp_cw_widget_id . "\" charset=\"utf-8\" crossorigin=\"anonymous\" type=\"text/javascript\" defer></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $actualResult = $flowWidgetClass->getWidgetId();

        $this->assertEquals($this->wp_cw_widget_id, $actualResult);
    }

    public function testGETAndDataWidgetIdWorks()
    {
        $wp_cw_script = "<script id=\"flow-widget\" src=\" " . $this->wp_cw_src . "?widgetId=" . $this->wp_cw_widget_id . "\" data-widget-id=\"0b1f2018-e44a-4422-b392-3e1a46dc82dc\" charset=\"utf-8\" crossorigin=\"anonymous\" type=\"text/javascript\" defer></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $actualResult = $flowWidgetClass->getWidgetId();

        $this->assertEquals($this->wp_cw_widget_id, $actualResult);
    }

    public function testNoSpaceInScript()
    {
        $wp_cw_script = "<script src=\"" . $this->wp_cw_src . "?widgetId=" . $this->wp_cw_widget_id . "\"></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $actualResult = $flowWidgetClass->getWidgetId();

        $this->assertEquals($this->wp_cw_widget_id, $actualResult);
    }

    /**
     * @expectedException Exception
     */
    public function testEmptySrc()
    {
        $this->expectException(Exception::class);
        $wp_cw_script = "<script src=\"\"></script>";

        $flowWidgetClass = new FlowWidgetClass($wp_cw_script);
        $flowWidgetClass->getWidgetURI();
    }

    public function testScriptInputAsArray()
    {
        $wp_cw_script = "<script id=\"flow-widget\" src=\"" . $this->wp_cw_src . "\" charset=\"utf-8\" crossorigin=\"anonymous\" data-widget-id=\"" . $this->wp_cw_widget_id . "\" type=\"text/javascript\" defer></script>";
        $script_array = str_split($wp_cw_script);

        $flowWidgetClass = new FlowWidgetClass($script_array);
        $actualResult = $flowWidgetClass->getWidgetId();

        $this->assertEquals($this->wp_cw_widget_id, $actualResult);
    }
}
