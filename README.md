# ST Assetment

> Additional information or tagline

Voucher API Generator

## Installing / Getting started

```shell
docker-compose up -d
```

After that go ahead and visit or curl `http://localhost:8000`

## API Features

For API setup, you may look at thunder-collection_Sugarbook.json

1. [POST] Generate 3,000,000 Vouchers - `localhost:8000/api/voucher/generate` -
NOTE: please wait a few seconds, you will get an `id` for you to track its progress
```shell
{
  "id": "97869778-54ad-4061-82c5-ea8fcc913081",
  ...
}
```

2. [GET] Return total processing time of batch based on `id` - `localhost:8000/voucher/batch?id=97869778-54ad-4061-82c5-ea8fcc913081`. You can get `id` for return on API 1.
```shell
{
  "id": "97869778-54ad-4061-82c5-ea8fcc913081",
  "time_taken": "182 seconds.",
  "status": "25%",
  "totalJobs": 300,
  "pendingJobs": 225,
  "processedJobs": 75,
  "failedJobs": 0,
  "createdAt": "2022-10-17T21:47:06.000000Z",
  "cancelledAt": null,
  "finishedAt": null
}
```

3. [GET] Get voucher - `localhost:8000/voucher/get`
```shell
{
  "voucher_code": "90dfec",
  "status": "Available",
  "expiry_date": "2022-10-20 20:26:20"
}
```

4. [GET] Claim voucher - `localhost:8000/voucher/claim?code=5502b9`
```shell
{
  "voucher_code": "90dfec",
  "status": "Claimed",
  "expiry_date": "2022-10-20 20:26:20"
}
```
,
5. [GET] View voucher stats - `localhost:8000/voucher/stats`
```shell
{
  "available": 375085,
  "claimed": 1,
  "expired": 374914,
  "no_expire_6H": 31258,
  "no_expire_12H": 62583,
  "no_expire_24H": 125286
}
```

## Contributing

## Links

## Licensing

None
