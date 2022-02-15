<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 30.12.21
 * Time: 18:40
 */

namespace App\Model;


use Symfony\Component\HttpFoundation\Request;

/**
 * Interface ModelInterface
 * @package App\Model
 */
interface ModelInterface
{
    function create(Request $request): array;
    function edit(Request $request, int $id): void;
    function archive(int $id): void;
    function activate(int $id): void;
    function delete(int $id): object;
    function restore(int $id): void;

    public function dateFilter(Request $request): object;

    public function getEntityObject($id): object;
    function getList(Request $request): array;
    function getAllEntries(): array;
}
