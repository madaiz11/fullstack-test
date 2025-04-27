# Technical Questions and Answers

## 1. Time Investment in Testing

The time needed for writing tests really depends on how big and complex the business logic is, and how critical it is. The more critical it is, the more testing you need. On average, I'd say writing unit tests usually takes about 0.5 to 1.2 times the amount of time it takes to write the actual code for that part.

## 2. Security Measures

- SQL Injection: Prevent any SQL scripts from getting injected through input fields by properly filtering properties
- CORS: Only allow frontend requests from a specific host.

## 3. Performance Optimization Strategies

- Add indexes on columns that are often used in filters, search, or get operations.
- Check the API logic to see what kind of BigO complexity it has.
- Try to refactor it to make it simpler without affecting the business logic.
- You might be able to optimize it by:
  - Changing loops into mathematical formulas
  - Refactoring loop conditions
  - Using Boolean algebra to simplify complex conditions and reduce processing

## 4. Performance Issue Investigation

- Add logging at the function level in your APIs to trace if any functions are taking too long.
  - If you find one, dig into the code to check if it's caused by a big BigO complexity.
  - (You can write a decorator using monkey patching to intercept and measure function execution times.)
- Use metric tools like Grafana or Datadog to monitor:
  - Latency
  - Traffic
  - Errors around the time the issue happens
- Database-related investigations:
  - Check for slow queries, table scans, or locking issues
  - If you already know which query is slow, but you're not sure what's actually happening under the hood, you can run it with EXPLAIN ANALYZE, It'll show you exactly how the database processes the query — like what steps it takes, where it's spending most of the time, and whether it's doing things like table scans, index scans, or hitting some kind of bottleneck.
