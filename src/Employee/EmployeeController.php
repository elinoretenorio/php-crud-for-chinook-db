<?php

declare(strict_types=1);

namespace Chinook\Employee;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class EmployeeController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IEmployeeService $service;

    public function __construct(IEmployeeService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var EmployeeModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeId = (int) ($args["Employee_Id"] ?? 0);
        if ($employeeId <= 0) {
            return new JsonResponse(["result" => $employeeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var EmployeeModel $model */
        $model = $this->service->createModel($data);
        $model->setEmployeeId($employeeId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeId = (int) ($args["Employee_Id"] ?? 0);
        if ($employeeId <= 0) {
            return new JsonResponse(["result" => $employeeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var EmployeeModel $model */
        $model = $this->service->get($employeeId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var EmployeeModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeId = (int) ($args["Employee_Id"] ?? 0);
        if ($employeeId <= 0) {
            return new JsonResponse(["result" => $employeeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($employeeId);

        return new JsonResponse(["result" => $result]);
    }
}