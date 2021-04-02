<?php


class PostbackData extends Model
{
    public $ID;
    public $IFA;
    public $IP;
    public $CountryCode;
    public $CampaignID;
    public $CampaignName;
    public $GameID;
    public $SourceAppId;
    public $CreativePack;
    public $CreativePackId;
    public $DeviceModel;
    public $CPI;
    public $logTime;

    public function __construct($data)
    {
        $this->data = $data;
    }
}