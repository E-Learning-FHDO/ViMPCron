<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\Plugins\ViMP\Cron\ViMPJob;

/**
 * Class ilViMPCronPlugin
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilViMPCronPlugin extends ilCronHookPlugin
{

    //use DICTrait;

    const PLUGIN_CLASS_NAME = ilViMPPlugin::class;
    const PLUGIN_ID = "xvmpcron";
    const PLUGIN_NAME = "ViMPCron";
    /**
     * @var self|null
     */
    protected static ?ilViMPCronPlugin $instance = null;


    /**
     * ilViMPCronPlugin constructor
     */
    public function __construct()
    {
        global $DIC;
        $this->db = $DIC->database();
        parent::__construct(
            $this->db, $DIC["component.repository"], self::PLUGIN_ID
        );
    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @inheritDoc
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstance(string $a_job_id): ilCronJob
    {
        return new ViMPJob();
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstances() : array
    {
        return [
            new ViMPJob()
        ];
    }
}
