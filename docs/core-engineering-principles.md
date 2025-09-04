# 📄 Core Engineering Principles

## OOP - Object-Oriented Programming
- Encapsulation: Hide internal details; expose only what's necessary.
- Clear Responsibilities: Each class should have a well-defined role.
- Small Public APIs: Keep interfaces minimal and focused.

## SOLID - Five Principles of Object-Oriented Design
- S: Single Responsibility Principle – One reason to change.
- O: Open/Closed Principle – Open for extension, closed for modification.
- L: Liskov Substitution Principle – Subtypes must be substitutable.
- I: Interface Segregation Principle – Prefer many small interfaces.
- D: Dependency Inversion Principle – Depend on abstractions, not concretions.

## KISS - Keep It Simple, Stupid
Solve today’s problem simply; refactor only after green tests.

## DRY - Don’t Repeat Yourself
Reuse through interfaces/services, not copy-paste.

## YAGNI - You Aren’t Gonna Need It
No features/abstractions until a test/requirement demands it.

## Testing Pyramid Discipline
Emphasize unit/service tests; keep e2e minimal & essential.

## Documentation-First Development
- Stub the doc section before coding.
- Ship code with notes and explanations.

## Convention Over Configuration
Predictable names/paths (e.g., UserRepository, UserService, UsersController, /app/Domain|Infrastructure|Http).

## Fail Fast
- Validate early;
- Clear exceptions & logs;
- Never swallow errors.
