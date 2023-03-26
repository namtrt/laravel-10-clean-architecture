<?php

namespace Src\Infrastructure\Application\Middlewares;

use Illuminate\Support\Facades\DB;
use League\Tactician\Middleware;
use Src\Application\Contracts\Transactional;
use Throwable;

class TransactionMiddleware implements Middleware
{
    private bool $inTransaction = false;

    /**
     * @throws Throwable
     */
    public function execute($command, callable $next)
    {
        if ($this->inTransaction) {
            return $next($command);
        }

        if ($command instanceof Transactional) {
            DB::beginTransaction();
            $this->inTransaction = true;
            try {
                $returnValue = $next($command);
                DB::commit();
            } catch (Throwable $throwable) {
                $this->inTransaction = false;
                DB::rollBack();

                throw $throwable;
            }

            return $returnValue;
        }

        return $next($command);
    }
}

