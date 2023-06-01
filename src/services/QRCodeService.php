<?php
/**
 * QRCode plugin for Craft CMS 3.x
 *
 * Generate a QR code
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2019 Kurious Agency
 */

namespace kuriousagency\qrcode\services;

use kuriousagency\qrcode\QRCode as Plugin;

use Craft;
use craft\base\Component;
use craft\helpers\Template;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;


/**
 * @author    Kurious Agency
 * @package   QRCode
 * @since     0.0.1
 */
class QRCodeService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function generate($data, $size=null)
    {
		if (gettype($data) == 'array') {
			$data = json_encode($data);
		}
		       
$writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create($data)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize($size)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin());


        return Template::raw( $writer->write($qrCode)->getDataUri() );
    }
}
