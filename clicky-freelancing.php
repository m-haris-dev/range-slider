<?php
/*
Plugin Name: Clicky Freelancing
Description: Custom Plugin
Version: 1.0
Author: Clickysoft
*/

function calculate_percentage($atts) {
    // Extract attributes and set default values
    $atts = shortcode_atts(
        array(
            'value1' => 0,
            'value2' => 1,
        ),
        $atts,
        'percentage_calculator'
    );

    // Ensure the values are numeric
    $value1 = floatval($atts['value1']);
    $value2 = floatval($atts['value2']);

    // Prevent division by zero
    if ($value2 == 0) {
        return "Error: Division by zero";
    }

    // Calculate the percentage
    $percentage = ($value1 / $value2) * 100;
    $percentage_int = intval($percentage);

    // Generate the HTML output
    $output = '
    <div class="progress-main-container">
        <div class="progress-container">
            <div class="progress-text">Available Spots: <span>' . $value2 . '</span></div>
            <div class="progress-bar" style="width: ' . $percentage_int . '%;">
                <div class="tooltip">Only <span>' . $value1 . '</span> Spots Left</div>
            </div>
        </div>
    </div>
    <style>
        .progress-main-container{
            padding-top: 30px;
            overflow: hidden;
            height: 150px;
        }
        .progress-container {
            width: 100%;
            background-color: #ffffff;
            border-radius: 20px;
            font-family: "Open Sans", Sans-serif;
            position: relative;
        }
    
        .progress-bar {
            background-color: #2196F3;
            height: 15px;
            border-radius: 20px 0px 0px 20px;
            position: relative;
        }
    
        .progress-text {
            position: absolute;
            left: 10px;
            top: -30px;
            color: black;
        }
        .progress-text span{
            font-weight: bold;
        }
    
        .tooltip {
            position: absolute;
            right: -62px;
            top: 60px;
            background-color: black;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 13px;
        }
        .tooltip:before {
            content: "";
            background-image:url('.plugin_dir_url(__FILE__).'/arrow.png);
            background-repeat: no-repeat;
            width: 100%;
            height: 100px;
            position: absolute;
            top: -60px;
            left: 50%;
        }
        @media(max-width:768px){
            .tooltip{
                padding:10px;
                font-size: 12px;
                right: -52px;
                right: 0px;
            }
            .tooltip:before{
                left: 95%;
            }
        }
    </style>
    ';

    // Return the generated HTML
    return $output;
}

// Register the shortcode
add_shortcode('percentage_calculator', 'calculate_percentage');
