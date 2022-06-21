<?php

use common\models\Equipment;
use yii\db\Migration;


/**
 * Class m220616_111725_equipment
 */
class m220616_111725_equipment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{equipment}}',[
            'code' => $this->string(10)->notNull(),
            'name' => $this->string(32)->notNull(),
        ]);
        $this->addPrimaryKey('equipment_pk', 'equipment', ['code']);
        $container = [
            "20GP" => "20FT GENERAL PURPOSE",
            "V" => "Van",
            "F" => "Flatbed",
            "R"=> "Refrigerated (Reefer)",
            "VR" => "Van or Reefer",
            "VRF" => "Flatbed, Van or Reefer",
            "2F" => "Two 24 or 28 Foot Flatbeds",
            "ANIM" => "Animal Carrier",
            "AUTO" => "Auto Carrier",
            "BDMP" => "Belly Dump",
            "BEAM "=> "Beam",
            "BELT" => "Conveyor Belt",
            "BOAT" =>" Boat Hauling Trailer",
            "B-TR "=> "B-Train/Supertrain (Canada only)",
            "CH" => "Convertible Hopper",
            "CONG" => "Conestoga",
            'CONT' => "Container Trailer",
            'CV' => "Curtain Van",
            "DA" => "Drive Away",
            "DD" => "Double Drop",
            "DDE" => "Double Drop Extendable",
            "DUMP" => "Dump Trucks",
            "ENDP" => "End Dump",
            "FA" => "FlatBed - Air-Ride",
            "FEXT" => "Stretch Trailers or Extendable Flatbed",
            "FINT "=> "Flatbed Intermodal",
            "FO" => "Flatbed Over-Dimension Loads",
            "FRV" => "Flatbed, Van or Reefer",
            "FSD "=> "Flatbed or Step Deck",
            "FSDV" => "Flatbed, Step Deck or Van",
            "FV" => "Van or Flatbed",
            "FVR "=> "Flatbed, Van or Reefer",
            "FVV" => "Flatbed or Vented Van",
            "FVVR" => "Flatbed, Vented Van or Reefer",
            "FWS" => "Flatbed With Sides",
            "HOPP" => "Hopper Bottom",
            "HS" => "Hot Shot",
            "HTU" => "Haul and Tow Unit",
            "LAF" => "Landoll Flatbed",
            "LB" => "Lowboy",
            "LBO" => "Lowboy Over-Dimension Loads",
            "LDOT" => "Load-Out are empty trailers you load and haul",
            "LIVE" => "Live Bottom Trailer",
            "MAXI" => "Maxi or Double Flat Trailers",
            "MBHM" => "Mobile Home",
            "PNEU" => "Pneumatic",
            "PO" => "Power Only (Tow-Away)",
            "RFV" => "Flatbed, Van or Reefer",
            "RGN" => "Removable Goose Neck & Multi-Axle Heavy Haulers",
            "RGNE" => "RGN Extendable",
            "RINT" => "Refrigerated Intermodal",
            "ROLL" => "Roll Top Conestoga",
            "RPD" => "Refrigerated Carrier with Plant Decking",
            "RV" => "Van or Reefer",
            "RVF" => "Flatbed, Van or Reefer",
            "SD" => "Step Deck",
            "SDC" => "Step Deck Conestoga",
            "SDE" => "Step Deck Extendable",
            "SDL" => "Step Deck with Loading Ramps",
            "SDO" => "Step Deck Over-Dimension Loads",
            "SDRG" =>" Step Deck or Removable Gooseneck",
            "SPEC" => "Unspecified Specialized Trailers",
            "SPV" => "Cargo/Small/Sprinter Van",
            "SV" => "Straight Van",
            "TANK" => "Tanker (Food grade, liquid, bulk, etc.)",
            "VA" => "Van - Air-Ride",
            "VB" => "Blanket Wrap Van",
            "VCAR "=> "Cargo Vans (1 Ton capacity)",
            "VF" =>" Flatbed or Van",
            "VFR" => "Flatbed, Van or Reefer",
            "VINT" => "Van Intermodal",
            "VIV" => "Vented Insulated Van",
            "VIVR" => "Vented Insulated Van or Refrigerated",
            "VLG" => "Van with Liftgate",
            "VM "=> "Moving Van",
            "V-OT" => "Open Top Van",
            "VRDD "=> "Van, Reefer or Double Drop",
            "VV" => "Vented Van",
            "VVR "=> "Vented Van or Refrigerated",
            "WALK" => "Walking Floor",
        ];

        foreach ($container as $stateCode => $state) {
            $model = new equipment();
            $model->code = $stateCode;
            $model->name = $state;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220616_111725_equipment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220616_111725_equipment cannot be reverted.\n";

        return false;
    }
    */
}
