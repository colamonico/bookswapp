<?php
     /**************************************************************************************
     * Bookswapp is a web application which allow students to exchange their textbooks
     * It is developed by students of ITE "C. Colamonico" - Sistemi Informativi Aziendali
     * Acquaviva delle Fonti (BA) - Italy
     *
     * Bookswapp is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation
     *
     * Bookswapp is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along 
     * with this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact ITE "C. Colamonico" with a mailing address at Via Colamonico, 5 
     * 70021 - Acquaviva delle Fonti (BA) Italy, or at email address bookswapp@itccolamonico.it.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Bookswapp
     * logo and ITE "C. Colamonico" copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright ITE C. Colamonico - http://www.itccolamonico.it - 2014. All rights reserved".
     ****************************************************************************************/
?>
<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%adoption}}".
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $year_adoption
 * @property integer $classroom_id
 * @property integer $book_id
 * @property integer $owned
 * @property integer $to_buy
 * @property integer $advised
 * @property string $price_adoption
 * @property integer $subject_id
 *
 * @property Book $book
 * @property Classroom $classroom
 * @property School $school
 * @property Subject $subject
 * @property Publisher $publisher
 */
class Adoption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%adoption}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'year_adoption', 'classroom_id', 'book_id', 'owned', 'to_buy', 'advised', 'price_adoption', 'subject_id'], 'required'],
            [['school_id', 'classroom_id', 'book_id', 'owned', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption'], 'safe'],
            [['price_adoption'], 'number'],
            [['school_id', 'year_adoption', 'classroom_id', 'book_id'], 'unique', 'targetAttribute' => ['school_id', 'year_adoption', 'classroom_id', 'book_id'], 'message' => 'The combination of School ID, Year Adoption, Classroom ID and Book ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'year_adoption' => Yii::t('app', 'Year Adoption'),
            'classroom_id' => Yii::t('app', 'Classroom ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'owned' => Yii::t('app', 'owned'),
            'to_buy' => Yii::t('app', 'To Buy'),
            'advised' => Yii::t('app', 'Advised'),
            'price_adoption' => Yii::t('app', 'Price Adoption'),
            'subject_id' => Yii::t('app', 'Subject ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id'=>'publisher_id'])
                    ->viaTable('{{%book}}', ['id' => 'book_id']);
    }
}
