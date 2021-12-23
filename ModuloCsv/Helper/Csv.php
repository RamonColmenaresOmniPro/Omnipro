<?php
namespace Omnipro\ModuloCsv\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\File\Csv as MagentoCsv;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;

class Csv extends AbstractHelper
{
     /**
     * @var DirectoryList
     */
    protected $directoryList;
    /**
     * @var MagentoCsv
     */
    protected $csv;
    /**
     * @var File
     */
    protected $file;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        DirectoryList $directoryList,
        MagentoCsv $csv,
        File $file
    )
    {
        parent::__construct($context);
        $this->directoryList = $directoryList;
        $this->csv = $csv;
        $this->file = $file;
    }

    public function readCsv()
    {
        $data = "";
        $csvFilePath = "pub/media/import/csv/catalog_product.csv";
        $rootDirectory = $this->directoryList->getRoot();
        $csvFile = $rootDirectory . "/" . $csvFilePath;
        try {
            if ($this->file->isExists($csvFile)) {
                //set delimiter, for tab pass "\t"
                $this->csv->setDelimiter(",");
                //get data as an array
                $data = $this->csv->getData($csvFile);
                if (!empty($data)) {
                    // ignore first header column and read data
                    foreach (array_slice($data, 1) as $key => $value) {
                        $columnFirst = trim($value['0']);
                        $columnSecond = trim($value['1']);
                        //and so on.
                    }
                }
            } else {
                $this->_logger->info('Csv file not exist');
                return __('Csv file not exist');
            }
        } catch (FileSystemException $e) {
            $this->_logger->info($e->getMessage());
        }
        return $data;
    }
}
