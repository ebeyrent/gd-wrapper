<?php
/**
 * Defines JpgWritter class.
 *
 * @author Henrique Barcelos
 */
namespace GdWrapper\Io\Writer;

use GdWrapper\Io\Exception;
use GdWrapper\Io\Preset;

/**
 * Defines an implementation of a I/O device for JPEG files.
 *
 * Because JPEG files can have `.jpg` and `.jpeg` extensions, this class is needed
 * for the right operation of `ReaderFactory`, which tries to create a reader
 * based on a file extension.
 */
class JpgWriter extends JpegWriter {
    // No need to change implementation
}
