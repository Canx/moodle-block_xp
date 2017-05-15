<?php

trait Transaction {

    protected static function execute_as_transaction($function) {
        global $DB;

        try {
            try {
                $transaction = $DB->start_delegated_transaction ();
                $function ();
                $transaction->allow_commit ();
            } catch ( Exception $e ) {
                debugging("Transaction exception, doing rollback:" . $e->getMessage());
                if (! empty ( $transaction ) && ! $transaction->is_disposed ()) {
                    $transaction->rollback ( $e );
                }
                return false;
            }
        } catch ( Exception $e ) {
            debugging("Rollback Exception:" . $e->getMessage());
            return false;
        }

        return true;

    }
}