# 📄 Core Engineering Principles

## OOP
Encapsulation, clear responsibilities, small public APIs.

## SOLID
Interfaces + DI; open/closed; single responsibility.

## KISS
Solve today’s problem simply; refactor only after green tests.

## DRY
Reuse through interfaces/services, not copy-paste.

## YAGNI
No features/abstractions until a test/requirement demands it.

## Testing Pyramid Discipline
Emphasize unit/service tests; keep e2e minimal & essential.

## Documentation-First Development
Stub the doc section before coding; ship code with notes.

## Convention Over Configuration
Predictable names/paths (e.g., UserRepository, UserService, UsersController, /app/Domain|Infrastructure|Http).

## Fail Fast
Validate early; clear exceptions & logs; never swallow errors.