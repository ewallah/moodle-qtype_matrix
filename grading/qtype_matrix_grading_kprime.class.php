<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * Total grading - i.e. including rows.
 *
 * The student must choose all correct answers, and none of the wrong ones
 * to get 100% otherwise he gets 0%. Including rows.
 * If one row is wrong then the mark for the question is 0.
 */
class qtype_matrix_grading_kprime extends qtype_matrix_grading
{

    const TYPE = 'kprime';

    public static function get_name() {
        return self::TYPE;
    }

    public static function get_title() {
        return qtype_matrix::get_string(self::TYPE);
    }

    /**
     * Factory
     *
     * @param string $type
     * @return qtype_matrix_grading_kprime
     */
    public static function create($type) {
        static $result = false;
        if ($result) {
            return $result;
        }
        return $result = new self();
    }

    /**
     * Returns the question's grade. By default it is the average of correct questions.
     *
     * @param qtype_matrix_question $question
     * @param array                 $answers
     * @return float
     */
    public function grade_question($question, $answers) {
        foreach ($question->rows as $row) {
            $grade = $this->grade_row($question, $row, $answers);
            if ($grade < 1) {
                return 0;
            }
        }
        return 1;
    }


    /**
     * Grade a row
     *
     * @param qtype_matrix_question $question   The question to grade
     * @param integer|object $row               Row to grade
     * @param array $responses                  User's responses
     * @return float                            The row grade, either 0 or 1
     */
    public function grade_row($question, $row, $responses) {
        foreach ($question->cols as $col) {
            $answer = $question->answer($row, $col);
            $response = $question->response($responses, $row, $col);
            if ($answer != $response) {
                return 0;
            }
        }
        return 1;
    }

}
